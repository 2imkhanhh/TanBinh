<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Liên hệ mới từ Khách hàng</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }
        .header {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            padding: 30px;
            text-align: center;
            color: #ffffff;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }
        .content {
            padding: 40px 30px;
            color: #334155;
            line-height: 1.6;
        }
        .intro {
            font-size: 16px;
            margin-bottom: 30px;
        }
        .info-card {
            background-color: #f8fafc;
            border-radius: 12px;
            padding: 24px;
            border: 1px solid #e2e8f0;
            margin-bottom: 30px;
        }
        .info-row {
            margin-bottom: 16px;
        }
        .info-label {
            font-weight: 600;
            color: #475569;
            margin-bottom: 4px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .info-value {
            color: #0f172a;
            font-size: 16px;
        }
        .message-box {
            background-color: #eff6ff;
            border-left: 4px solid #3b82f6;
            border-radius: 4px;
            padding: 16px;
            margin-top: 10px;
            color: #1e3a8a;
            white-space: pre-wrap;
            font-size: 15px;
        }
        .footer {
            background-color: #f8fafc;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Liên hệ mới nhận được</h1>
        </div>
        <div class="content">
            <p class="intro">Chào bạn, hệ thống {{ config('app.name') }} vừa nhận được một yêu cầu liên hệ mới từ khách hàng qua biểu mẫu liên hệ. Dưới đây là thông tin chi tiết:</p>
            
            <div class="info-card">
                <div class="info-row">
                    <div class="info-label">Họ và tên</div>
                    <div class="info-value">{{ $contact->fullname }}</div>
                </div>
                <div class="info-row" style="margin-top: 16px;">
                    <div class="info-label">Email</div>
                    <div class="info-value">
                        <a href="mailto:{{ $contact->email }}" style="color: #3b82f6; text-decoration: none;">{{ $contact->email }}</a>
                    </div>
                </div>
                <div class="info-row" style="margin-top: 16px;">
                    <div class="info-label">Số điện thoại</div>
                    <div class="info-value">
                        <a href="tel:{{ $contact->phone }}" style="color: #3b82f6; text-decoration: none;">{{ $contact->phone ?: 'Không cung cấp' }}</a>
                    </div>
                </div>
                <div class="info-row" style="margin-top: 16px;">
                    <div class="info-label">Thời gian gửi</div>
                    <div class="info-value">{{ $contact->created_at->format('d/m/Y H:i:s') }}</div>
                </div>
                <div class="info-row" style="margin-top: 20px;">
                    <div class="info-label">Nội dung lời nhắn</div>
                    <div class="message-box">{{ $contact->content }}</div>
                </div>
            </div>
            
            <p style="margin-bottom: 0; font-size: 14px; color: #64748b;">Bạn có thể quản lý và phản hồi các liên hệ này trong trang quản lý Admin của hệ thống.</p>
        </div>
        <div class="footer">
            <p>Email này được tự động gửi từ hệ thống {{ config('app.name') }}.</p>
        </div>
    </div>
</body>
</html>
