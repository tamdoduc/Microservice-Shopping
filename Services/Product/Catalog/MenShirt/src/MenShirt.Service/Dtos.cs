using System;

namespace Product.Catalog.MenShirt.Service.Dtos
{
    public record MenShirtDto(Guid Id, Guid IdAccount, string NameProduct,string Image, int MinPrice,int MaxPrice, int CountSold, double CountStar, int Discount);
    public record CreateMenShirtDto(Guid IdAccount, string NameProduct,string Image, int MinPrice,int MaxPrice, int CountSold, double CountStar, int Discount);
    public record UpdateMenShirtDto(Guid Id, Guid IdAccount, string NameProduct,string Image, int MinPrice,int MaxPrice, int CountSold, double CountStar, int Discount);
    public record DeleteMenShirtDto(Guid Id);
}