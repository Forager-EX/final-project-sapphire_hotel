// routes/userRoutes.js
const express = require("express");
const router = express.Router();
const pool = require("../db/database");

// @route   GET /api/users
// @desc    Get all users
router.get("/", async (req, res) => {
  try {
    const [rows] = await pool.query("SELECT * FROM user");
    res.json(rows);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// @route   POST /api/users
// @desc    Register a new user
router.post("/", async (req, res) => {
  const { name, email, phone, password } = req.body;
  if (!name || !email || !phone) {
    return res
      .status(400)
      .json({ error: "Name, email, and phone are required." });
  }

  try {
    const [result] = await pool.query(
      "INSERT INTO user (name, email, phone, password, createdAt) VALUES (?, ?, ?, ?, CURDATE())",
      [name, email, phone, password || null] // Ensure password is set to NULL if not provided
    );
    res.status(201).json({ message: "User created", user_id: result.insertId });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// @route   PUT /api/users/:user_id
// @desc    Update a user
router.put("/:user_id", async (req, res) => {
  const { user_id } = req.params;
  const { name, email, phone, password } = req.body;

  if (!name || !email || !phone) {
    return res.status(400).json({ error: "All fields are required." });
  }

  try {
    const [result] = await pool.query(
      "UPDATE user SET name = ?, email = ?, phone = ?, password = ? WHERE user_id = ?",
      [name, email, phone, password || null, user_id] // Ensure password is set to NULL if not provided
    );

    if (result.affectedRows === 0) {
      return res.status(404).json({ error: "User not found." });
    }

    res.json({ message: "User updated successfully." });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// @route   DELETE /api/users/:user_id
// @desc    Delete a user
router.delete("/:user_id", async (req, res) => {
  const { user_id } = req.params;

  try {
    const [result] = await pool.query("DELETE FROM user WHERE user_id = ?", [
      user_id,
    ]);

    if (result.affectedRows === 0) {
      return res.status(404).json({ error: "User not found." });
    }

    res.json({ message: "User deleted successfully." });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

module.exports = router;
