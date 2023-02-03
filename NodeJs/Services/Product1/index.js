require("dotenv").config();
const express = require("express");
const mongoose = require("mongoose");
const cors = require("cors");

const productRouter = require("./routes/product");

const connectDB = async () => {
  try {
    await mongoose.connect(
      `mongodb+srv://turtle19520253:19520253@cluster0.rbbiuxh.mongodb.net/?retryWrites=true&w=majority`
    );
    console.log("MongoDB connected");
  } catch (error) {
    console.log(error.message);
    process.exit(1);
  }
};
connectDB();

const app = express();

app.use(cors({ origin: "*" }));

app.use(express.json());
app.use(express.urlencoded({ extended: true }));

app.use("/api/products", productRouter);
const PORT = 5000;

app.listen(PORT, () => console.log(`Server started on port ${PORT}`));

app.get("/", (req, res) => res.send("PRODUCT ROUTE"));
module.exports = app;
