#!/bin/bash

echo "===================================="
echo "Git Commit and Push Script"
echo "===================================="
echo ""

echo "[1/4] Checking git status..."
git status
echo ""

echo "[2/4] Adding all files..."
git add -A
echo ""

echo "[3/4] Committing changes..."
git commit -m "Update: remove filters, add social media icons, update footer, add mission section and partners"
echo ""

echo "[4/4] Pushing to GitHub..."
git push origin main
echo ""

echo "===================================="
echo "Done!"
echo "===================================="
