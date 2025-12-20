# API Endpoints Documentation

Base URL: `http://laravel1.test/api`

## Posts Endpoints

- **GET** `/api/posts` - Get all posts (paginated)
- **GET** `/api/posts/{post}` - Get single post
- **POST** `/api/posts` - Create new post
- **PUT** `/api/posts/{post}` - Update post
- **PATCH** `/api/posts/{post}` - Partially update post
- **DELETE** `/api/posts/{post}` - Delete post

## Post Comments Endpoints

- **GET** `/api/posts/{post}/comments` - Get all comments for a post (paginated)
- **GET** `/api/posts/{post}/comments/{comment}` - Get single comment
- **POST** `/api/posts/{post}/comments` - Create new comment
- **PUT** `/api/posts/{post}/comments/{comment}` - Update comment
- **PATCH** `/api/posts/{post}/comments/{comment}` - Partially update comment
- **DELETE** `/api/posts/{post}/comments/{comment}` - Delete comment
