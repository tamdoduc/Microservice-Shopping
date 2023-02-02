# Get base SDK Image from Microsoft
FROM mcr.microsoft.com/dotnet/core/sdk:2.2 AS build-env
WORKDIR /app

# Copy the CSPROJ files and restore any dependecies (via NUGET)
COPY *.csproj ./
# copy nuget.config
COPY *.config ./
ARG FEED_SOURCE
ARG FEED_ACCESSTOKEN
RUN dotnet new nugetconfig --force
RUN dotnet nuget add source %FEED_SOURCE% -n PrivateFeed -u docker -p %FEED_ACCESSTOKEN% --store-password-in-clear-text --configfile nuget.config
RUN dotnet restore 

# Copy the project files and build our release
COPY . ./
RUN dotnet publish -c Release -o out

# Generate runtime image
FROM mcr.microsoft.com/dotnet/core/aspnet:2.2
WORKDIR /app
EXPOSE 80
COPY --from=build-env /app/out .
ENTRYPOINT ["dotnet","DockerAPI.dll"]