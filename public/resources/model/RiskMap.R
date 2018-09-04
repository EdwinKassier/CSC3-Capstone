# Script that uses a model created by Megan Murgatroyd to generate a risk map
# Josh Redelinghuys
# EAGLEWEB CAPSTONE 14/08/2018

# Changes to integrate with PHP
# Charl Ritter
# EAGLEWEB CAPSTONE 04/09/2018

##### VARIABLES #####

#region = dev.terrain = the shapefile
#finalArea = elevation + shpefile cropped
#region.terrain = dev.terrain = the dataframe of all data pertaining to the finalArea

#Gets the params from php
args <- commandArgs(TRUE)
mainPAth <- args[1]
modelPAth <- args[2]
savePAth <- args[3]

##### Set working directory to locate files #####
#set this path to wherever 
setwd(mainPAth) # where the model and all files need to be

##### Load Megan's model "riskmod.rds" #####
require(effects)
riskmod <- readRDS("riskmod.rds") #this is the file that Megan is likely to change
#summary(riskmod)

##### Load user shapeFile #####
require(rgdal)
require(raster)

##Read in shapefile
filename <- list.files(path=paste(modelPAth, "/", sep=""), pattern="+.*shp")

##Find the name of the shapefiles
shapefile <- strsplit(filename, ".shp" )[[1]]
shapefile

#Load shapefile
region = readOGR(modelPAth,shapefile) 

##### Determine which elevation maps are needed #####
# deleted 45 to 232
risk = read.csv("risk.csv")

risk_plot=rasterFromXYZ(risk)

spplot(risk_plot)

library(mapview)

crs(risk_plot) <- sp::CRS("+proj=longlat +ellps=WGS84 +datum=WGS84 +no_defs")

m3 <- mapview(risk_plot, alpha.regions = 0.50, na.color = "transparent")
mapshot(m3, file = paste0(getwd(), paste("/", path=paste(modelPAth, path=paste(savePAth, "/risk_map.png", sep=""), sep=""), sep="")))
print("12 - Map png printed")
mapshot(m3, url = paste0(getwd(), paste("/", path=paste(modelPAth, path=paste(savePAth, "/risk_map.html", sep=""), sep=""), sep="")))
print("12 - Map html printed")

dev.off() 

