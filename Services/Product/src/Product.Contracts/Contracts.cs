using System;

namespace Product.Service{
    public record ProductCreated(Guid Id, Guid IdAccount, string NameProduct,string Image, int MinPrice,int MaxPrice, int Discount);
    public record ProductUpdated(Guid Id, Guid IdAccount, string NameProduct,string Image, int MinPrice,int MaxPrice, int CountSold, double CountStar, int Discount);
    public record ProductDelete(Guid Id);
    public record CountSoldIncreased(Guid Id, int Value);
}