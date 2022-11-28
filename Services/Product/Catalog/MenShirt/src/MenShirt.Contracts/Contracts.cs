using System;

namespace Product.Catalog.MenShirt.Contracts{
    public record MenShirtCreated(Guid Id, Guid IdAccount, string NameProduct,string Image, int MinPrice,int MaxPrice, int Discount);
    public record MenShirtUpdated(Guid Id, Guid IdAccount, string NameProduct,string Image, int MinPrice,int MaxPrice, int CountSold, double CountStar, int Discount);
    public record MenShirtDeleted(Guid Id);
    public record CountSoldIncreased(Guid Id, int Value);
}