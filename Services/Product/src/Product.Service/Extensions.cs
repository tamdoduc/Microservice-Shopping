using Product.Service.Dtos;
using Product.Service.Entities;

namespace Product.Service
{
    public static class Extensions
    {
        public static ProductDto AsDto(this ProductDao product){
            return new ProductDto(product.Id,product.IdAccount,product.NameProduct,product.Image,product.MinPrice,product.MaxPrice,product.CountSold,product.CountStar,product.Discount);
        }
    }
}