
using Product.Catalog.MenShirt.Service.Dtos;
using Product.Catalog.MenShirt.Service.Entities;

namespace Product.Catalog.MenShirt.Service.Extensions
{
    public static class Extensions
    {
        public static MenShirtDto AsDto(this MenShirtDao product){
            return new MenShirtDto(product.Id,product.IdAccount,product.NameProduct,product.Image,product.MinPrice,product.MaxPrice,product.CountSold,product.CountStar,product.Discount);
        }
    }
}