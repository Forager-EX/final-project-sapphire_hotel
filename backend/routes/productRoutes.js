const express = require("express");
const router = express.Router();
const { runAsync, getAsync, allAsync } = require("../db/database");

// Create product
router.post("/", async (req, res) => {
  try {
    const { name, description, price, image_url, category, stock } = req.body;

    const result = await runAsync(
      "INSERT INTO products (name, description, price, image_url, category, stock) VALUES (?, ?, ?, ?, ?, ?)",
      [name, description, price, image_url, category, stock || 0]
    );

    const product = await getAsync("SELECT * FROM products WHERE id = ?", [
      result.lastID,
    ]);
    res.status(201).json(product);
  } catch (error) {
    res.status(400).json({ message: error.message });
  }
});

// Get all products
router.get("/", async (req, res) => {
  try {
    const products = await allAsync("SELECT * FROM products");
    res.json(products);
  } catch (error) {
    res.status(500).json({ message: error.message });
  }
});

// Get single product
router.get("/:id", async (req, res) => {
  try {
    const product = await getAsync("SELECT * FROM products WHERE id = ?", [
      req.params.id,
    ]);

    if (!product) {
      return res.status(404).json({ message: "Product not found" });
    }

    res.json(product);
  } catch (error) {
    res.status(500).json({ message: error.message });
  }
});

// Update product
router.put("/:id", async (req, res) => {
  try {
    const { name, description, price, image_url, category, stock } = req.body;

    const product = await getAsync("SELECT * FROM products WHERE id = ?", [
      req.params.id,
    ]);
    if (!product) {
      return res.status(404).json({ message: "Product not found" });
    }

    await runAsync(
      "UPDATE products SET name = ?, description = ?, price = ?, image_url = ?, category = ?, stock = ? WHERE id = ?",
      [name, description, price, image_url, category, stock, req.params.id]
    );

    const updatedProduct = await getAsync(
      "SELECT * FROM products WHERE id = ?",
      [req.params.id]
    );
    res.json(updatedProduct);
  } catch (error) {
    res.status(400).json({ message: error.message });
  }
});

// Delete product
router.delete("/:id", async (req, res) => {
  try {
    const product = await getAsync("SELECT * FROM products WHERE id = ?", [
      req.params.id,
    ]);
    if (!product) {
      return res.status(404).json({ message: "Product not found" });
    }

    await runAsync("DELETE FROM products WHERE id = ?", [req.params.id]);
    res.json({ message: "Product deleted" });
  } catch (error) {
    res.status(500).json({ message: error.message });
  }
});

module.exports = router;
