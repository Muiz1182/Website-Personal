================================================
MMA PRODUCTION - PENGAJUAN PROYEK BARU
Videography • Designer • Web Developer
================================================

Halo Mochammad Muiz,

Ada pengajuan proyek baru yang masuk melalui formulir website:

Nama Pengirim / Perusahaan: {{ $data['name'] ?? '-' }}
Email Pengirim: {{ $data['email'] ?? '-' }}
Pilar / Kategori: {{ $data['category_label'] ?? $data['category'] }}
Waktu Pengiriman: {{ $data['submitted_at'] ?? now()->format('d M Y, H:i') }} WIB

Rincian & Sasaran Proyek:
------------------------------------------------
{{ $data['details'] ?? '-' }}
------------------------------------------------

Anda dapat langsung membalas email ini (Reply) untuk menghubungi calon klien di {{ $data['email'] }}.

--
MMA Production | Mochammad Muiz Afdloly
muiz1182.business@gmail.com

