using System;
using Base.Service;

namespace Product.Service.Entities
{
    public class ProductDao : IEntity
    {
        public Guid Id { get; set; }
        public Guid IdAccount { get; set; }
        public string NameProduct { get; set; }
        public string Image { get; set; }
        public int MinPrice { get; set; }
        public int MaxPrice { get; set; }
        public int CountSold { get; set; }
        public double CountStar { get; set; }
        public int Discount { get; set; }
    }
}