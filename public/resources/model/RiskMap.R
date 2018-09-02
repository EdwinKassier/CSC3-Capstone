# Script that uses a model created by Megan Murgatroyd to generate a risk map
# Josh Redelinghuys
# EAGLEWEB CAPSTONE 14/8/18

#packages you need to install to run (you only need to do this strp the first time):
install.packages("effects")
install.packages("lme4")
install.packages("rgdal")
install.packages("raster")
install.packages("geosphere")

##### VARIABLES #####
#shapefile name
#array of nests
#elevation maps

#region = dev.terrain = the shapefile
#finalArea = elevation + shpefile cropped
#region.terrain = dev.terrain = the dataframe of all data pertaining to the finalArea


##### Set working directory to locate files #####
#set this path to wherever 
setwd("c:/Users/Josh/Desktop/EAGLEWEB draft") # where the model and all files need to be

##### Load Megan's model "riskmod.rds" #####
require(effects)
riskmod <- readRDS("riskmod.rds") #this is the file that Megan is likely to change
#summary(riskmod)

##### Load user shapeFile !NOTE! Load any named shapefile? #####
require(rgdal)
require(raster)

region = readOGR(".","penninsula") #penninsula will have a different shapefile name

##### Determine which elevation maps are needed #####

#1st: extract the corner points of the shape
##DETERMINE THE EXTENT OF THE REGION

spread = extent(region)
xmin = floor(spread@xmin[[1]])
xmax = floor(spread@xmax[[1]])
ymin = floor(abs(spread@ymin[[1]]))
ymax = floor(abs(spread@ymax[[1]]))

#2nd for each of the corner points, determine which map they lie in

#SRTM 34 covers areas from -33 to -34
#so for the y values of the region, 1 is added to the int of the srtm value
# e.g. -34.4 is contained in s35, -33.9 is contained in s34

#WORST (likely) CASE = 4 TILES

# 17.4------33.8-----18.6
#    |   x   |        |
#    |       |      x |
#    |------34--------|
#    |       |        |
#    |x      |  x     |
#    |     34.4       |
#    ------------------

#loop through all x values and all y values and load x*y srtms

#DEBUG TEST
#  17 18 
#34
#35

##Determine number of maps required
x.required = xmax-xmin + 1 #Num of x maps needed
y.required = ymin-ymax + 1 #Num of y maps needed
N = x.required*y.required #total num of maps needed


##Generate the map files and file names needed
map.files <- list()
map.names <- list()
i = 1
for(a in xmin:xmax){
  #print(a)
  for(b in ymax:ymin){
    print(paste("S",b+1,"E0",a,".hgt", sep = ""))
    map.files[[i]] <- paste("S",b+1,"E0",a,".hgt", sep = "")
    map.names[[i]] <- paste("S",b+1,"E0",a, sep = "")
    i = i +1
  }
}

#3rd Load the maps (all .hgt files needed)
maps <- list()
for(i in 1:N){
  filepath = paste(map.files[[i]], sep = "") #THIS DIRECTORY IS HARDCODED
  print(filepath)
  maps[[i]] <- (assign(map.names[[i]], raster(filepath))) #assign the raster layer its name
}

#4th merge maps
if(N>1){
  map.merged <- do.call(merge, maps)
} else {
  map.merged <- maps[[1]]
}

#visulaise the development region with the shape file area overlayed
elevation <- crop(map.merged, region)
plot(elevation)
plot(region, add=T)

#remove the trash
rm(map.files, map.names, maps)

##### Extract data from the elevation map: THE SLOW PART #####

#Extract the info needed for the model:
slope<-terrain(elevation, opt=c('slope'), unit='degrees', neighbors=8)
aspect<-terrain(elevation, opt=c('aspect'), unit='degrees')
slope_sd3=focal(slope, w=matrix(1,3,3), fun=sd) ##NB this layer take 5min+ to make. It is taking each grid cell and finding the standard deviation of the altitude of it and the cells around it on a 3x3 grid (i.e. SD of 9 cells)
#make a terrain.stack of these layers:
terrain.stack_pen<-stack(list(slope=slope,  aspect=aspect, slope_sd3=slope_sd3, alt=elevation)) 

#Crop the terrain.stack by the development boundaries:
crs(region)=crs(elevation)
finalArea <- crop(terrain.stack_pen, extent(region), snap='out')
rar <- mask(finalArea, region)

#convert the raster to points, and convert these points to a dataframe:
rarToP <- rasterToPoints(rar, byid=TRUE, id=rar$nests)
rm(rar)
region.terrain <- as.data.frame(rarToP)
#head(region.terrain) #view first lines of terrain

#change x y column names:
names(region.terrain)[names(region.terrain) == "x"] <- "longitude"
names(region.terrain)[names(region.terrain) == "y"] <- "latitude"

##### Add nests to the map #####

#Define the coords of the region
coords=data.frame(long=region.terrain$longitude, lat=region.terrain$latitude)

#Read in csv files each containing a nest coord: LONG, LAT
temp = list.files(pattern = "*.csv")
List = lapply(temp, read.csv) # put each coord set in a list

distances <- vector('list', length(List)) #create list of vector distances
#calculate the distance from each nest
for(i in seq_along(List)){
  distance = distGeo(coords, List[[i]])/1000
  distances[[i]] <- as.data.frame(distance)
}

dists = data.frame(distances) #distNest1 | distNest2 | distNest3
#head(dists)
min.dists = apply(dists,1, FUN=min) #find the closest nest but selecteing the smallest distances

#Set the closest nest and add to dataframe
region.terrain$nest_dist=min.dist

##### Add categorical vars and produce risk map #####
#add categorical aspect to dataframe:
region.terrain$asp4<-
  ifelse((region.terrain$aspect <= 45 | region.terrain$aspect >= 315), "N",
         ifelse((region.terrain$aspect >= 45 & region.terrain$aspect < 125), "E",
                ifelse((region.terrain$aspect >= 125 & region.terrain$aspect < 225), "S",
                       ifelse((region.terrain$aspect >= 225 & region.terrain$aspect < 315), "W", "NA"))))
region.terrain$asp4=as.factor(region.terrain$asp4)


####Data frame in now ready to run the model over:
pred<-predict(riskmod, region.terrain, re.form = NA, type = "response", na.action = na.fail)

pred=as.data.frame(pred)

#you now have probablities 0 -1 which need plotting / converting to tiff / raster:
summary(pred$pred)

#RISK PLOT:
toplot=cbind(long= region.terrain$longitude, lat=region.terrain$latitude, pred=pred$pred)
head(toplot)
risk_plot=rasterFromXYZ(toplot)

colours=c("darkseagreen1","darkorange","red")
plot(risk_plot, col=colours)
plot(dev, add=T)