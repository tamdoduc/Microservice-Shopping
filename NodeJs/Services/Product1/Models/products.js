const mongoose = require("mongoose");
const schema = mongoose.Schema;

const ProductsSchema = new schema({
  nameProduct: {
    type: String,
    require: true,
  },
  accountId: {
    type: schema.Types.ObjectId,
    ref: "accounts",
  },
  imageURL: {
    type: Number,
    require: true,
  },
  minPrice: {
    type: Number,
    require: true,
  },
  maxPrice: {
    type: Number,
    require: true,
  },
  countSold: {
    type: Number,
    default: 0,
  },
  countStar: {
    type: Number,
    default: 0,
  },
  discount: {
    type: Number,
    default: 0,
  },
});

module.exports = mongoose.model("productTemps", ProductsSchema);
