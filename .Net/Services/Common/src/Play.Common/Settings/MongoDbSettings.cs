namespace Play.Common.Settings
{
    public class MongoDbSettings
    {
        public string Host { get; init; }
        public int Post { get; init; }
        public string ConnectionString => $"mongodb://{Host}:{Post}";
    }
}