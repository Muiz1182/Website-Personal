<x-layouts.app :strings="$strings">

    <!-- 01. Hero Section -->
    <x-sections.hero :strings="$strings['hero'] ?? []" :lanyardImage="$lanyardImage ?? '/images/lanyard-front.svg'" />

    <!-- 02. Selected Works (The Core Portfolio) -->
    <x-sections.selected-works :projects="$projects" :strings="$strings['works'] ?? []" />

    <!-- 03. Capabilities & Deliverables -->
    <x-sections.technical-mastery :services="$services" :strings="$strings['services'] ?? []" />

    <!-- 04. Director & Lead Profile -->
    <x-sections.team :team="$team" :strings="$strings['team'] ?? []" />

    <!-- 05. Client Collaborations & Quotes -->
    @if (!empty($testimonials) && count($testimonials) > 0)
        <x-sections.client-echo :testimonials="$testimonials" :strings="$strings['clients'] ?? []" />
    @endif

    <!-- 06. Contact & Commission Inquiries -->
    <x-sections.contact-form :strings="$strings['contact'] ?? []" />

    <!-- 07. Modal Pengumuman Popup Tengah Layar -->
    <x-announcement-modal :announcement="$announcement ?? null" />

</x-layouts.app>
