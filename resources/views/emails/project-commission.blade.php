<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Proyek Baru</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #0A0A0C;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            color: #E4E4E7;
            -webkit-text-size-adjust: 100%;
        }
        .container {
            max-width: 600px;
            margin: 32px auto;
            background-color: #121216;
            border: 1px solid #27272A;
            border-radius: 8px;
            overflow: hidden;
        }
        .header {
            background-color: #070708;
            padding: 28px 32px;
            border-bottom: 2px solid #FF5722;
        }
        .brand {
            font-size: 20px;
            font-weight: 900;
            letter-spacing: 2px;
            color: #FFFFFF;
            text-transform: uppercase;
            margin: 0;
        }
        .brand span {
            color: #FF5722;
        }
        .brand-sub {
            font-size: 11px;
            color: #A1A1AA;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-top: 4px;
        }
        .content {
            padding: 32px;
        }
        .badge {
            display: inline-block;
            background-color: #FF5722;
            color: #FFFFFF;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 5px 12px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        h2 {
            font-size: 22px;
            font-weight: 800;
            color: #FFFFFF;
            margin: 0 0 16px 0;
            letter-spacing: -0.5px;
        }
        p {
            font-size: 14px;
            line-height: 1.6;
            color: #D4D4D8;
            margin: 0 0 20px 0;
        }
        .meta-card {
            background-color: #18181E;
            border: 1px solid #27272A;
            border-radius: 6px;
            padding: 20px;
            margin-bottom: 24px;
        }
        .meta-row {
            padding: 10px 0;
            border-bottom: 1px solid #27272A;
        }
        .meta-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        .meta-row:first-child {
            padding-top: 0;
        }
        .meta-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #A1A1AA;
            font-weight: 600;
            margin-bottom: 4px;
        }
        .meta-value {
            font-size: 15px;
            color: #FFFFFF;
            font-weight: 600;
        }
        .meta-value a {
            color: #FF5722;
            text-decoration: none;
        }
        .details-box {
            background-color: #0E0E12;
            border-left: 3px solid #FF5722;
            padding: 16px 20px;
            margin-top: 8px;
            border-radius: 0 6px 6px 0;
            font-size: 14px;
            line-height: 1.7;
            color: #F4F4F5;
            white-space: pre-wrap;
            word-break: break-word;
        }
        .btn-wrapper {
            margin: 28px 0;
            text-align: center;
        }
        .btn {
            display: inline-block;
            background-color: #FF5722;
            color: #FFFFFF !important;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 4px;
        }
        .footer {
            background-color: #070708;
            padding: 20px 32px;
            border-top: 1px solid #27272A;
            text-align: center;
            font-size: 12px;
            color: #71717A;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1 class="brand">MMA<span>.</span>PRODUCTION</h1>
            <div class="brand-sub">Videography &bull; Designer &bull; Web Developer</div>
        </div>

        <!-- Main Body -->
        <div class="content">
            <div class="badge">Pengajuan Proyek Baru</div>
            <h2>Ada formulir proyek baru masuk dari website!</h2>
            <p>Seorang calon klien baru saja mengirimkan rincian kebutuhan proyek melalui formulir pemesanan website portofolio Anda.</p>

            <!-- Metadata Box -->
            <div class="meta-card">
                <div class="meta-row">
                    <div class="meta-label">Nama Pengirim / Perusahaan</div>
                    <div class="meta-value">{{ $data['name'] ?? '-' }}</div>
                </div>

                <div class="meta-row">
                    <div class="meta-label">Alamat Email Pengirim</div>
                    <div class="meta-value">
                        <a href="mailto:{{ $data['email'] }}">{{ $data['email'] ?? '-' }}</a>
                    </div>
                </div>

                <div class="meta-row">
                    <div class="meta-label">Pilar / Kategori Kebutuhan</div>
                    <div class="meta-value" style="color: #FF5722;">{{ $data['category_label'] ?? $data['category'] }}</div>
                </div>

                <div class="meta-row">
                    <div class="meta-label">Waktu Pengiriman</div>
                    <div class="meta-value" style="font-size: 13px; font-weight: normal; color: #A1A1AA;">
                        {{ $data['submitted_at'] ?? now()->format('d M Y, H:i') }} WIB
                    </div>
                </div>

                <div class="meta-row">
                    <div class="meta-label">Rincian &amp; Sasaran Proyek</div>
                    <div class="details-box">{{ $data['details'] ?? '-' }}</div>
                </div>
            </div>

            <!-- Reply Button -->
            <div class="btn-wrapper">
                <a href="mailto:{{ $data['email'] }}?subject=Re:%20Diskusi%20Proyek%20MMA%20Production%20-%20{{ rawurlencode($data['name'] ?? '') }}" class="btn">
                    Balas Email Klien
                </a>
            </div>

            <p style="font-size: 12px; color: #71717A; margin-top: 24px;">
                Catatan: Anda juga dapat langsung menekan tombol <strong>Reply</strong> di aplikasi Gmail Anda untuk membalas email ke <strong>{{ $data['email'] }}</strong>.
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            &copy; {{ date('Y') }} MMA Production &bull; Mochammad Muiz Afdloly &bull; Email otomatis sistem website
        </div>
    </div>
</body>
</html>

