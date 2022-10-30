using Product.Service.Dtos;
using Product.Service.Entities;

namespace Product.Service
{
    public static class Extensions
    {
        public static ProductDto AsDto(this ProductDao product){
            return new ProductDto(product.Id,product.IdAccount,product.NameProduct,product.Price,product.CountSold,product.CountAvailable,product.CountStar,product.Description,product.Type);
        }
        public static ImageProductDto AsDto(this ImageProductDao imageProduct){
            return new ImageProductDto(imageProduct.Id, imageProduct.IdProduct, imageProduct.ImageURL);
        }
        public static ColorProductDto AsDto(this ColorProductDao colorProduct){
            return new ColorProductDto(colorProduct.Id, colorProduct.IdProduct, colorProduct.NameColor);
        }
    }
}