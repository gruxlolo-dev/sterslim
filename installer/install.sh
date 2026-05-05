#!/bin/bash

echo "🚀 Installing sterslim..."

composer install

cp .env.example .env

echo "✅ Ready!"
