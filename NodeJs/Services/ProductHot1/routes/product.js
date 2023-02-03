const express = require("express");
const multer = require("multer");
const router = express.Router();

const amqp = require("amqplib");

const Product = require("../Models/products");

const uploadMultipartForm = multer().none();

router.get("/", (req, res) => res.send("PRODUCT ROUTE"));

// @route POST api/products/create
// @desc Create product
// @access Public
router.post("/create", async (req, res) => {
  try {
    const { nameProduct, imageURL, minPrice, maxPrice, discount } = req.body;

    if (!nameProduct || !imageURL || !minPrice || !maxPrice)
      return res
        .status(400)
        .json({ success: false, message: "Missing information" });

    const newProduct = new Product({
      nameProduct,
      imageURL,
      minPrice,
      maxPrice,
      discount,
    });

    //All good

    newProduct.save();
    res.json({
      success: true,
      message: "Product created successfully",
      productID: newProduct._id,
    });
  } catch (error) {
    console.log(error);
    res.status(500).json({
      success: false,
      message: " Internal server error",
    });
  }
});

// @route GET api/products/all
// @desc Get All Product
// @access Public
router.get("/all", async (req, res) => {
  try {
    const products = await Product.find();
    res.json({ success: true, products });
  } catch (error) {
    console.log(error);
    res.status(500).json({
      success: false,
      message: " Internal server error",
    });
  }
});

// @route GET api/products/byProductId
// @desc Get Product by productId
// @access Public
router.get("/byProductId", async (req, res) => {
  const productId = req.body.productId;
  try {
    const product = await Product.findOne({
      _id: productId,
    });
    res.json({ success: true, product });
  } catch (error) {
    console.log(error);
    res.status(500).json({
      success: false,
      message: " Internal server error",
    });
  }
});

// @route Delete api/products/byProductId
// @desc delete 1 product
// @access Public
router.delete("/byProductId", async (req, res) => {
  const productId = req.body.productId;
  console.log("productId: ", productId);
  try {
    Product.findByIdAndDelete(productId, function (error, product) {
      if (error) res.json({ success: false, error });
      if (product) res.json({ success: true, message: "Deleted", product });
      else {
        res.json({ success: false, message: "Not found" });
      }
    });
  } catch (error) {
    console.log(error);
    res.status(500).json({
      success: false,
      message: " Internal server error",
    });
  }
});

// @route PUT api/products/update
// @desc update Product
// @access Public
router.put("/update", async (req, res) => {
  try {
    const {
      productId,
      nameProduct,
      imageURL,
      minPrice,
      maxPrice,
      countSold,
      countStar,
      discount,
    } = req.body;
    Product.findOneAndUpdate(
      { _id: productId },
      {
        productId,
        nameProduct,
        imageURL,
        minPrice,
        maxPrice,
        countSold,
        countStar,
        discount,
      },
      { new: true },
      function (error, product) {
        console.log(product);
        if (!product) {
          res.status(400).json({
            success: false,
            message: "product not found",
          });
        } else {
          res.status(200).json({
            success: true,
            message: " Updated product",
            product,
          });
        }
      }
    );
  } catch (error) {
    console.log(error);
    res.status(500).json({
      success: false,
      message: " Internal server error",
    });
  }
});

// @route PUT api/products/upSoldCount
// @desc update
// @access Public
router.put("/upSoldCount", async (req, res) => {
  try {
    const { productId, newCount } = req.body;
    Product.findOneAndUpdate(
      { _id: productId },
      {
        countSold: newCount,
      },
      { new: true },
      function (error, product) {
        console.log(product);
        if (!product) {
          res.status(400).json({
            success: false,
            message: "product not found",
          });
        } else {
          res.status(200).json({
            success: true,
            message: " Updated product",
            product,
          });
        }
      }
    );
    // All Good
  } catch (error) {
    console.log(error);
    res.status(500).json({
      success: false,
      message: " Internal server error",
    });
  }
});

module.exports = router;
