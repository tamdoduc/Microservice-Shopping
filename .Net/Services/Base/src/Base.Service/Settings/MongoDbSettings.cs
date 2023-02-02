namespace Base.Service.Settings
{
    public class MongoDbSettings
    {
        public string Host { get; set; }
        public string Port { get; set; }
        public string ConnectString { get; set; }

        // public string ConnectionString => $"mongodb://{Host}:{Port}";
        public string ConnectionString => ConnectString;
    }
}
