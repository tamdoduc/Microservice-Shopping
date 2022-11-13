using System;

namespace Product.Service.Dtos
{
    public record ProductDto(Guid Id, Guid IdAccount, string NameProduct, int Price, int CountSold, int CountAvailable, double CountStar, string Description, string Type);
    public record ImageProductDto(Guid Id, Guid IdProduct, string ImageUrl);
    public record ColorProductDto(Guid Id, Guid IdProduct, string nameColor);

    public record CreateProductDto(Guid IdAccount, string NameProduct, int Price, int CountSold, int CountAvailable, double CountStar, string Description, string Type);
    public record CreateImageProductDto(Guid IdProduct, string ImageUrl);
    public record CreateColorProductDto(Guid IdProduct, string nameColor);

    public record UpdateProductDto(Guid Id, Guid IdAccount, string NameProduct, int Price, int CountSold, int CountAvailable, double CountStar, string Description, string Type);
}