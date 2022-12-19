using System;
using Play.Common;

namespace Shop.Service.Entities
{
    public class ShopDao : IEntity
    {
        public Guid Id { get; set; }
        public Guid AccountId { get; set; }
        public string Name { get; set; }
        public int EvaluationCount { get; set; }
        public double StarRating { get; set; }
        public DateTime JoinDate { get; set; }
        public int ProductCount { get; set; }
        public int FollowerCount { get; set; }
    }
}