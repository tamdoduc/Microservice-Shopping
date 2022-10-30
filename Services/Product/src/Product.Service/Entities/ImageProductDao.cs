using System;
using Base.Service;

namespace Product.Service.Entities
{
    public class ImageProductDao : IEntity
    {
        public Guid Id { get; set; }
        public Guid IdProduct { get; set; }
        public string ImageURL { get; set; }
    }
}