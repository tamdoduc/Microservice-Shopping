using System;
using Base.Service;

namespace Product.Service.Entities
{
    public class ColorProductDao : IEntity
    {
        public Guid Id { get; set; }
        public Guid IdProduct { get; set; }
        public string NameColor { get; set; }
    }
}