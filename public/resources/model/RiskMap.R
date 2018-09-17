# FINAL VERSION 12:00 9/5/18

# Script that uses a model created by Megan Murgatroyd to generate a risk map
# Josh Redelinghuys
# EAGLEWEB CAPSTONE 14/08/2018

# Changes to integrate with PHP
# Charl Ritter
# EAGLEWEB CAPSTONE 04/09/2018

##### Note: VARIABLES #####
#region = dev.terrain = the shapefile
#finalArea = elevation + shpefile cropped
#region.terrain = dev.terrain = the dataframe of all data pertaining to the finalArea

##### START debug output text #####
#sink('report.txt')

##### Load Packages & Add-ins #####
shhh <- suppressPackageStartupMessages # surpress warning messages when loading packages!
shhh(require(effects))
shhh(require(rgdal))
shhh(require(raster))
shhh(require(geosphere))
shhh(library(mapview))

#Gets the params from php
args <- commandArgs(TRUE)
mainPAth <- args[1]
modelPAth <- args[2]
savePAth <- args[3]

print(mainPAth)

##### Set working directory to locate files #####
#set this path to wherever 
setwd(mainPAth) # where the model and all files need to be

##### Load Megan's model "riskmod.rds" #####
riskmod <- readRDS("riskmod.rds") #this is the file that Megan is likely to change

##### Load user shapeFile #####

#Find the name of the shapefiles
filename <- list.files(path=paste0(modelPAth, "/"), pattern="+.*shp")
shapefile <- strsplit(filename, ".shp" )[[1]]
print(paste("Loading user input shapefiles:" , shapefile, "..."))

#Load shapefile
region = readOGR(modelPAth,shapefile)
print(paste("Succesfully loaded" , shapefile))

##### Determine which elevation maps are needed #####
print(paste("Determining the elevation maps required..."))
#1st Determine the extent of the region
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
    print(paste("Requiring map: ","S",b+1,"E0",a,".hgt", sep = ""))
    map.files[[i]] <- paste("S",b+1,"E0",a,".hgt", sep = "")
    map.names[[i]] <- paste("S",b+1,"E0",a, sep = "")
    i = i +1
  }
}

#3rd Load the maps (all .hgt files needed)
print("Loading maps required...")
maps <- list()
for(i in 1:N){
  filepath = paste("srtm_dems/",map.files[[i]], sep = "") #THIS DIRECTORY IS HARDCODED
  #print(filepath)
  maps[[i]] <- (assign(map.names[[i]], raster(filepath))) #assign the raster layer its name
}

#4th merge maps
if(N>1){
  map.merged <- do.call(merge, maps)
} else {
  map.merged <- maps[[1]]
}
elevation <- map.merged
print("Maps succesfully merged.")

#visulaise the development region with the shape file area overlayed
#plot(elevation)
#plot(region, add=T)

##### Extract data from the elevation map: THE SLOW PART #####
print("Calculating terrain data...")
#Extract the info needed for the model:
slope<-terrain(elevation, opt=c('slope'), unit='degrees', neighbors=8)
print("Slope successfully calculated.")
aspect<-terrain(elevation, opt=c('aspect'), unit='degrees')
print("Aspect successfully calcualted.")

#load in precaluclated values
for(j in 1:N){
  filepath = paste0("slopes/",map.names[[j]],".tif") #THIS DIRECTORY IS HARDCODED
  maps[[j]] <- (assign(map.names[[j]], raster(filepath))) #assign the raster layer its name
}

#4th merge precalculation
if(N>1){
  map.merged <- do.call(merge, maps)
} else {
  map.merged <- maps[[1]]
}
slope_sd3 <- map.merged
print("Standard Deviation successfully calcualted.")

#slope_sd3=focal(slope, w=matrix(1,3,3), fun=sd) ##NB this layer take 5min+ to make. It is taking each grid cell and finding the standard deviation of the altitude of it and the cells around it on a 3x3 grid (i.e. SD of 9 cells)
#make a terrain.stack of these layers:
#print("3 - LONG slope_sd3 calculation complete")

#create stack of all calculated values
terrain.stack_pen<-stack(list(slope=slope,  aspect=aspect, slope_sd3=slope_sd3, alt=elevation)) 
print("Geographical calculations complete.")

#remove the trash
rm(map.files, maps, map.names)

#Crop the terrain.stack by the development boundaries:
print("Cropping development boundaries...")
crs(region)=crs(elevation)
finalArea <- crop(terrain.stack_pen, extent(region), snap='out')
rar <- mask(finalArea, region)

#convert the raster to points, and convert these points to a dataframe:
rarToP <- rasterToPoints(rar, byid=TRUE, id=rar$nests)
rm(rar)
region.terrain <- as.data.frame(rarToP)

#change x y column names:
names(region.terrain)[names(region.terrain) == "x"] <- "longitude"
names(region.terrain)[names(region.terrain) == "y"] <- "latitude"

#head(region.terrain) #view first lines of region.terrain
print("Region terrain calculated.")

##### Add nest data #####
#Define the coords of the region
coords=data.frame(long=region.terrain$longitude, lat=region.terrain$latitude)

print("Reading in user nest data...")
#Create a dataframe for each nest in NESTDATA.csv
nestData <- read.csv("NESTDATA.csv", sep = ",", header=TRUE) #big list of all nests
nests <- list()
for(i in 1:dim(nestData)[1]){
  temp = strsplit(as.character(nestData$Nest.LONG.LAT[i]), ',')
  new_str <- paste(as.character(temp[[1]][1]), " <- data.frame(long = ", temp[[1]][2], ",lat = ", temp[[1]][3], ")")
  #print(new_str)
  if(nestData$Nest[i] == "") break
  nests[[i]] <- eval(parse(text = new_str))
}

#create list of vector distances from each nest to each point in the region
distances <- vector('list', length(nests)) 

#calculate the distance from each nest
for(i in seq_along(nests)){
  distance = distGeo(coords, nests[[i]])/1000
  distances[[i]] <- as.data.frame(distance)
}
print("Nest distances calculated.")

#find the closest nest but selecteing the smallest distances
dists = data.frame(distances) #distNest1 | distNest2 | distNest3
#head(dists)
min.dists = apply(dists,1, FUN=min) 

#Set the closest nest and add to dataframe
region.terrain$nest_dist=min.dists

#remove trash
rm(nests)

##### Add categorical vars and produce risk map #####
print("Beginning prediction...")
#add categorical aspect to dataframe:
region.terrain$asp4<-
  ifelse((region.terrain$aspect <= 45 | region.terrain$aspect >= 315), "N",
         ifelse((region.terrain$aspect >= 45 & region.terrain$aspect < 125), "E",
                ifelse((region.terrain$aspect >= 125 & region.terrain$aspect < 225), "S",
                       ifelse((region.terrain$aspect >= 225 & region.terrain$aspect < 315), "W", "NA"))))
region.terrain$asp4=as.factor(region.terrain$asp4)

#### Data frame in now ready to run the model over: ####
#removed na.action = na.fail
#make predicition
pred<-predict(riskmod, region.terrain, re.form = NA, type = "response")
pred=as.data.frame(pred)

#you now have probablities 0 -1 which need plotting / converting to tiff / raster:
#summary(pred$pred)
print("Predicition complete.")

#### RISK PLOT: ####
toplot=cbind(long= region.terrain$longitude, lat=region.terrain$latitude, pred=pred$pred)
#head(toplot)
#write.csv(toplot, file = "user_outputs\\11\\risk.csv",row.names=FALSE)
#convert points and prediction to raster
risk_plot=rasterFromXYZ(toplot)

#add geo tag
crs(risk_plot) <- sp::CRS("+proj=longlat +ellps=WGS84 +datum=WGS84 +no_defs")

#DEBUG:view plot
#spplot(risk_plot)
print("Producing map...")
map <- mapview(risk_plot, alpha.regions = 0.50, na.color = "transparent", map.types = "Esri.WorldImagery")
#map

mapshot(map, file = paste0(getwd(),"/", modelPAth, savePAth, "/risk_map.png"))
print("Map png printed.")
mapshot(map, url = paste0(getwd(),"/", modelPAth, savePAth, "/risk_map.html"))
print("Map html generated.")

#Zip it up 
#library(Rcompression)
print("Start compression")
d = paste0(getwd(),"/", modelPAth, savePAth)
setwd(d)
list.files()
zip("risk_map.zip", c("risk_map.png", "risk_map.html", "risk_map_files"))

dev.off() 