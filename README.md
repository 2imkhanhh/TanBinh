# Tân Bình Tea — Website

Website giới thiệu Công ty TNHH Xuất Nhập Khẩu Chè Tân Bình.
Thuần HTML/CSS/JS, không cần build tool — mở `index.html` bằng trình duyệt là chạy.

## Cấu trúc thư mục

```
TanBinh-project/
├── index.html                  Trang chủ
├── gioi-thieu.html             Giới thiệu
├── san-pham.html               Danh sách sản phẩm
├── san-pham-chi-tiet.html      Chi tiết sản phẩm
├── blog.html                   Blog — Hình ảnh
├── blog-tin-tuc.html           Blog — Tin tức
├── blog-khac.html              Blog — Khác
├── lien-he.html                Liên hệ
│
└── assets/
    ├── css/
    │   ├── style.css               Dùng chung: reset, biến màu, header,
    │   │                           nav, footer, animation, breakpoints
    │   ├── index.css               Riêng trang chủ (dùng lại cho khối
    │   │                           liên hệ ở lien-he.html)
    │   ├── gioi-thieu.css
    │   ├── san-pham.css
    │   ├── san-pham-chi-tiet.css
    │   ├── blog.css
    │   ├── blog-tin-tuc.css
    │   ├── blog-khac.css
    │   └── lien-he.css
    │
    ├── js/
    │   └── main.js                 Toàn bộ JS: sticky header, mobile nav,
    │                               scroll animation, lightbox blog,
    │                               gallery sản phẩm, lọc danh mục, form
    │
    └── images/
        ├── common/                 Logo, lá trang trí, banner dùng chung
        ├── home/                   Ảnh trang chủ
        ├── about/                  Ảnh trang giới thiệu
        ├── products/               Ảnh sản phẩm
        └── blog/
            ├── gallery/            Ảnh thư viện blog
            └── news/               Ảnh tin tức
```

## Quy ước

- **Mỗi trang load 2 file CSS**: `style.css` (chung) + file CSS riêng của trang.
  `lien-he.html` load thêm `index.css` vì dùng lại khối form liên hệ.
- **Chỉ 1 file JS** (`main.js`) cho tất cả các trang; các module tự kiểm tra
  phần tử có tồn tại không trước khi chạy nên không lỗi khi thiếu.
- **Đặt ảnh mới**: bỏ vào đúng thư mục con trong `assets/images/`, tên file
  không dấu, không khoảng trắng, dùng gạch ngang (`ten-anh.png`).

## Responsive

Breakpoints dùng thống nhất: `1440 / 1280 / 1024 / 900 / 768 / 600 / 480 / 375 / 320px`.

Đã kiểm tra bằng trình duyệt thật (Chromium) ở 12 độ rộng từ 320px đến 1920px:
không trang nào bị cuộn ngang, không lỗi JS.

Riêng phần kích thước nút bấm cho màn hình cảm ứng nằm trong block
`@media (hover: none) and (pointer: coarse)` — chỉ áp dụng cho điện thoại và
máy tính bảng, **không ảnh hưởng giao diện desktop**.

## Ghi chú khi bảo trì

- Bản gốc là site tải về bằng HTTrack; các dấu vết của công cụ crawl
  (comment `Mirrored from...`, file `index-2.html` trùng lặp, ảnh
  `img/common/vector.html` thực chất là trang 404) đã được gỡ bỏ.
- Ảnh trong `assets/images/` chưa nén. Nếu cần tối ưu tốc độ tải, nên nén
  lại các file PNG lớn (`about/`, `home/`, `blog/` đang ~1–3MB mỗi thư mục)
  hoặc chuyển sang WebP.
