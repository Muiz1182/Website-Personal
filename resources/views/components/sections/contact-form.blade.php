@props(['strings' => []])

@php
    $isId = app()->getLocale() === 'id';
    $eyebrow = $strings['eyebrow'] ?? ($isId ? 'Konsultasi • Pemesanan Proyek' : 'Inquiries • Commissions');
    $title = $strings['title'] ?? ($isId ? 'MARI BERKARYA<br>BERSAMA.' : "LET'S CREATE<br>TOGETHER.");
    $subtitle = $strings['subtitle'] ?? ($isId ? 'Punya proyek video cinematic, rekaman podcast, desain UI/UX, ilustrasi, poster, atau pembuatan website (Laravel & Vue)? Sampaikan kebutuhan Anda atau hubungi langsung via WhatsApp maupun email.' : 'Have a project in cinematic video, podcast recording, UI/UX, illustration, posters, or web development (Laravel & Vue)? Fill out the brief below or get in touch directly via WhatsApp or email.');
    $emailLabel = $strings['email_label'] ?? ($isId ? 'Email Resmi' : 'Direct Email');
    $waLabel = $strings['wa_label'] ?? ($isId ? 'Kontak Instan (WhatsApp)' : 'Instant Booking (WhatsApp)');
    $waLinkText = $strings['wa_link_text'] ?? ($isId ? '+62 851 7442 1182 (Chat via WhatsApp)' : '+62 851 7442 1182 (Chat via WhatsApp)');
    $hubLabel = $strings['hub_label'] ?? ($isId ? 'Basis Kreatif' : 'Creative Hub');
    $hubVal = $strings['hub_val'] ?? ($isId ? 'Probolinggo, Jawa Timur, Indonesia' : 'Probolinggo, East Java, Indonesia');
    $hubSub = $isId ? 'Tersedia untuk proyek on-site maupun kolaborasi jarak jauh (remote)' : 'Available for on-site projects and remote collaborations';
    $bookingTitle = $isId ? 'Penerimaan Proyek Terbuka' : 'Available for New Commissions';
    $bookingSub = $isId ? 'Menerima proyek video cinematic, podcast, desain UI/UX, ilustrasi, poster, dan website developer (Laravel & Vue).' : 'Accepting commissions across cinematic video, podcasts, UI/UX, illustration, posters, and web development (Laravel & Vue).';
    $formTitle = $strings['form_title'] ?? ($isId ? 'Formulir Pemesanan Proyek' : 'Project Commission Form');
    $formSub = $strings['form_sub'] ?? ($isId ? 'Pilih lingkup kebutuhan dan ceritakan target proyek Anda. Kami merespons dalam 24 jam.' : 'Select your required scope and tell us about your goals. We respond within 24 hours.');
    $nameLabel = $strings['name_label'] ?? ($isId ? 'Nama Lengkap / Instansi' : 'Your Name / Company');
    $emailField = $strings['email_field'] ?? ($isId ? 'Email Perusahaan / Kerja' : 'Work Email');
    $serviceField = $strings['service_field'] ?? ($isId ? 'Pilar Kebutuhan Utama' : 'Primary Discipline');
    $conceptField = $strings['concept_field'] ?? ($isId ? 'Detail & Target Waktu Proyek' : 'Project Details & Timeline');
    $conceptPlace = $strings['concept_place'] ?? ($isId ? 'Ceritakan sekilas tentang proyek Anda, referensi karya, lingkup pekerjaan, serta target jadwal peluncuran...' : 'Describe your project, reference links, expected deliverables, and target delivery date...');
    $submitCta = $strings['submit_cta'] ?? ($isId ? 'KIRIM PENGAJUAN PROYEK' : 'SUBMIT PROJECT INQUIRY');
    $confidentialNotice = $strings['notice'] ?? ($isId ? 'Kami menjaga kerahasiaan penuh atas seluruh materi dan berkas proyek Anda.' : 'We treat all project briefs and files with strict confidentiality.');
@endphp

<section id="contact" class="bg-[#070707] text-[#F5F5F7] py-28 px-6 md:px-12 border-b border-[#1F1F24]">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-20">
        
        <!-- Left Studio Contact & Direct Booking Info -->
        <div class="lg:col-span-5 space-y-10">
            <div>
                <p class="text-xs uppercase tracking-[0.25em] font-semibold text-[#FF5722] mb-3">
                    {{ $eyebrow }}
                </p>
                <h2 class="font-display text-4xl sm:text-5xl lg:text-6xl font-black uppercase tracking-tight text-white leading-none">
                    {!! $title !!}
                </h2>
                <p class="text-neutral-400 text-base leading-relaxed mt-6">
                    {{ $subtitle }}
                </p>
            </div>

            <!-- Direct Contact Channels -->
            <div class="space-y-6 pt-4 border-t border-[#1F1F24]">
                <div class="flex items-start space-x-4">
                    <div class="w-10 h-10 bg-[#0E0E10] border border-[#1F1F24] flex items-center justify-center shrink-0 text-[#FF5722]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <span class="text-[10px] uppercase tracking-widest text-neutral-500 block font-semibold">{{ $emailLabel }}</span>
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=muiz1182.business@gmail.com" target="_blank" rel="noopener noreferrer" class="text-sm font-semibold text-white hover:text-[#FF5722] transition-colors">
                            muiz1182.business@gmail.com
                        </a>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="w-10 h-10 bg-[#0E0E10] border border-[#1F1F24] flex items-center justify-center shrink-0 text-[#FF5722]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <div>
                        <span class="text-[10px] uppercase tracking-widest text-neutral-500 block font-semibold">{{ $waLabel }}</span>
                        <a 
                            href="https://wa.me/6285174421182?text={{ $isId ? 'Halo%20MMA%20Production,%20saya%20tertarik%20untuk%20diskusi%20proyek%20(Videografi/Desain/Web).' : 'Hello%20MMA%20Production,%20I%20would%20like%20to%20discuss%20a%20project%20(Videography/Design/Web).' }}" 
                            target="_blank" 
                            rel="noopener noreferrer" 
                            class="text-sm font-semibold text-[#FF5722] hover:underline transition-colors"
                        >
                            {{ $waLinkText }}
                        </a>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="w-10 h-10 bg-[#0E0E10] border border-[#1F1F24] flex items-center justify-center shrink-0 text-[#FF5722]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <span class="text-[10px] uppercase tracking-widest text-neutral-500 block font-semibold">{{ $hubLabel }}</span>
                        <p class="text-sm text-neutral-300 font-medium">
                            {!! $hubVal !!}
                        </p>
                        <p class="text-xs text-neutral-500 mt-0.5">{{ $hubSub }}</p>
                    </div>
                </div>
            </div>

            <!-- Commission Availability Indicator -->
            <div class="p-5 bg-[#0E0E10] border border-[#1F1F24] flex items-center space-x-4">
                <span class="w-3 h-3 bg-emerald-500 rounded-full shrink-0"></span>
                <div class="text-xs">
                    <span class="font-bold text-white block">{{ $bookingTitle }}</span>
                    <span class="text-neutral-400">{{ $bookingSub }}</span>
                </div>
            </div>
        </div>

        <!-- Right Project Inquiry Form -->
        <div class="lg:col-span-7 bg-[#0E0E10] border border-[#1F1F24] p-8 md:p-12 shadow-2xl">
            <h3 class="font-display text-2xl font-bold uppercase tracking-tight text-white mb-2">
                {{ $formTitle }}
            </h3>
            <p class="text-xs text-neutral-400 mb-8">
                {{ $formSub }}
            </p>

            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="contact-name" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                            {{ $nameLabel }} <span class="text-[#FF5722]">*</span>
                        </label>
                        <input 
                            id="contact-name"
                            type="text" 
                            name="name" 
                            value="{{ old('name') }}" 
                            placeholder="{{ $isId ? 'Contoh: Bagas Pratama' : 'e.g. Sarah Jenkins' }}" 
                            autocomplete="name"
                            required
                            class="w-full bg-[#151518] border {{ $errors->has('name') ? 'border-red-500' : 'border-[#1F1F24]' }} p-4 text-sm text-white placeholder-neutral-600 focus:border-[#FF5722] outline-none transition-colors"
                        >
                        @error('name') 
                            <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> 
                        @enderror
                    </div>

                    <div>
                        <label for="contact-email" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                            {{ $emailField }} <span class="text-[#FF5722]">*</span>
                        </label>
                        <input 
                            id="contact-email"
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            placeholder="{{ $isId ? 'nama@agensi.com' : 'sarah@agency.com' }}" 
                            autocomplete="email"
                            required
                            class="w-full bg-[#151518] border {{ $errors->has('email') ? 'border-red-500' : 'border-[#1F1F24]' }} p-4 text-sm text-white placeholder-neutral-600 focus:border-[#FF5722] outline-none transition-colors"
                        >
                        @error('email') 
                            <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="contact-category" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                        {{ $serviceField }} <span class="text-[#FF5722]">*</span>
                    </label>
                    <select 
                        id="contact-category"
                        name="category" 
                        required
                        class="w-full bg-[#151518] border {{ $errors->has('category') ? 'border-red-500' : 'border-[#1F1F24]' }} p-4 text-sm text-white outline-none focus:border-[#FF5722] transition-colors"
                    >
                        <option value="" disabled {{ old('category') ? '' : 'selected' }}>
                            {{ $isId ? 'Pilih Kategori Kebutuhan Proyek' : 'Select Primary Discipline' }}
                        </option>
                        <option value="cinematic-video" {{ old('category') === 'cinematic-video' ? 'selected' : '' }}>
                            {{ $isId ? 'Video Cinematic & Iklan Komersial' : 'Cinematic Video & Commercial Film' }}
                        </option>
                        <option value="video-podcast" {{ old('category') === 'video-podcast' ? 'selected' : '' }}>
                            {{ $isId ? 'Produksi Video Podcast & Audio Studio' : 'Video Podcast Production & Studio Audio' }}
                        </option>
                        <option value="design-uiux" {{ old('category') === 'design-uiux' ? 'selected' : '' }}>
                            {{ $isId ? 'Desain UI/UX Web & Mobile (Figma)' : 'UI/UX Web & Mobile Design (Figma)' }}
                        </option>
                        <option value="design-illustration" {{ old('category') === 'design-illustration' ? 'selected' : '' }}>
                            {{ $isId ? 'Desain Ilustrasi Digital Kustom' : 'Custom Digital Illustration Design' }}
                        </option>
                        <option value="design-poster" {{ old('category') === 'design-poster' ? 'selected' : '' }}>
                            {{ $isId ? 'Desain Poster Komersial & Acara' : 'Commercial & Event Poster Design' }}
                        </option>
                        <option value="web-laravel-php" {{ old('category') === 'web-laravel-php' ? 'selected' : '' }}>
                            {{ $isId ? 'Website Developer (Laravel & PHP)' : 'Web Development (Laravel & PHP)' }}
                        </option>
                        <option value="web-vue-js" {{ old('category') === 'web-vue-js' ? 'selected' : '' }}>
                            {{ $isId ? 'Frontend Interaktif (Vue.js & JavaScript)' : 'Interactive Frontend (Vue.js & Modern JS)' }}
                        </option>
                        <option value="all-in-one" {{ old('category') === 'all-in-one' ? 'selected' : '' }}>
                            {{ $isId ? 'Paket Terpadu (Video + Desain + Website)' : 'Integrated Package (Video + Design + Web)' }}
                        </option>
                    </select>
                    @error('category') 
                        <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> 
                    @enderror
                </div>

                <div>
                    <label for="contact-details" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                        {{ $conceptField }} <span class="text-[#FF5722]">*</span>
                    </label>
                    <textarea 
                        id="contact-details"
                        name="details" 
                        rows="5" 
                        placeholder="{{ $conceptPlace }}" 
                        required
                        class="w-full bg-[#151518] border {{ $errors->has('details') ? 'border-red-500' : 'border-[#1F1F24]' }} p-4 text-sm text-white placeholder-neutral-600 focus:border-[#FF5722] outline-none transition-colors"
                    >{{ old('details') }}</textarea>
                    @error('details') 
                        <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> 
                    @enderror
                </div>

                <button 
                    type="submit" 
                    class="w-full min-h-[50px] bg-[#FF5722] hover:bg-[#F4511E] text-white font-bold text-xs uppercase tracking-widest py-4 transition-colors duration-200 focus-visible:outline-none"
                >
                    {{ $submitCta }}
                </button>
                <p class="text-center text-[11px] text-neutral-500">
                    {{ $confidentialNotice }}
                </p>
            </form>
        </div>
    </div>
</section>
