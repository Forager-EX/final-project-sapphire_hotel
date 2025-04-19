const express = require("express");
const router = express.Router();
const { runAsync, getAsync, allAsync } = require("../db/database");

// Create user
router.post("/", async (req, res) => {
  try {
    const { name, email, password, role = "user" } = req.body;

    const result = await runAsync(
      "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)",
      [name, email, password, role]
    );

    const user = await getAsync("SELECT * FROM users WHERE id = ?", [
      result.lastID,
    ]);
    res.status(201).json(user);
  } catch (error) {
    res.status(400).json({ message: error.message });
  }
});

// Get all users
router.get("/", async (req, res) => {
  try {
    const users = await allAsync("SELECT * FROM users");
    res.json(users);
  } catch (error) {
    res.status(500).json({ message: error.message });
  }
});

// Get single user
router.get("/:id", async (req, res) => {
  try {
    const user = await getAsync("SELECT * FROM users WHERE id = ?", [
      req.params.id,
    ]);

    if (!user) {
      return res.status(404).json({ message: "User not found" });
    }

    res.json(user);
  } catch (error) {
    res.status(500).json({ message: error.message });
  }
});

// Update user
router.put("/:id", async (req, res) => {
  try {
    const { name, email, role } = req.body;

    // First check if user exists
    const user = await getAsync("SELECT * FROM users WHERE id = ?", [
      req.params.id,
    ]);
    if (!user) {
      return res.status(404).json({ message: "User not found" });
    }

    await runAsync(
      "UPDATE users SET name = ?, email = ?, role = ? WHERE id = ?",
      [name, email, role, req.params.id]
    );

    const updatedUser = await getAsync("SELECT * FROM users WHERE id = ?", [
      req.params.id,
    ]);
    res.json(updatedUser);
  } catch (error) {
    res.status(400).json({ message: error.message });
  }
});

// Delete user
router.delete("/:id", async (req, res) => {
  try {
    const user = await getAsync("SELECT * FROM users WHERE id = ?", [
      req.params.id,
    ]);
    if (!user) {
      return res.status(404).json({ message: "User not found" });
    }

    await runAsync("DELETE FROM users WHERE id = ?", [req.params.id]);
    res.json({ message: "User deleted" });
  } catch (error) {
    res.status(500).json({ message: error.message });
  }
});

module.exports = router;
