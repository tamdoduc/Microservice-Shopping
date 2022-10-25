# Microservice-Shopping
# Update old web shopping (Monolit -> Microservice)

#Information
##Front-End: HTML, CSS, JavaScripts
##Back-End: C# .net 5.0
##Architecture : Microservice

#Command
## New service : dotnet new webapi -n Service.[:name] --framework net5.0
## Add package : dotnet add package [:name] --version 
## Create package : dotnet pack [to-source]
## Add Nuget : dotnet nuget add source [source] -n [:name]
## Remove Nuget: dotnet nuget remove source [:name]
## Docker Mongo: docker run -d --rm --name mongo -p 27017:27017 -v mongodbdata:/data/db mongo
