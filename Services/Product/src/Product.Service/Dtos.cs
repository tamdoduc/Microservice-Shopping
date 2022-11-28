using System;

namespace Product.Service.Dtos
{
    public record ProductDto(Guid Id, Guid IdAccount, string NameProduct,string Image, int MinPrice,int MaxPrice, int CountSold, double CountStar, int Discount);
    public record CreateProductDto(Guid IdAccount, string NameProduct,string Image, int MinPrice,int MaxPrice, int Discount);
    public record UpdateProductDto(Guid Id, Guid IdAccount, string NameProduct,string Image, int MinPrice,int MaxPrice, int CountSold, double CountStar, int Discount);
    public record DeleteProductDto(Guid Id);
    public record IncreaseCountSold(int Value);
}