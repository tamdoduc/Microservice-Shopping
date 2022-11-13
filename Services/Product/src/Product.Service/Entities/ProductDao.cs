using System;
using Base.Service;

namespace Product.Service.Entities
{
    public class ProductDao : IEntity
    {
        public Guid Id { get; set; }
        public Guid IdAccount { get; set; }
        public string NameProduct { get; set; }
        public int Price { get; set; }
        public int CountSold { get; set; }
        public int CountAvailable{ get; set; }
        public double CountStar { get; set; }
        public string Description { get; set; }
        public string Type { get; set; }
    }
}