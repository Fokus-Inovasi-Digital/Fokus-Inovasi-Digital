<img src="{{ $companyProfile->logo ? asset("storage/{$companyProfile->logo}") : asset('assets/default-img.jpg') }}"
    alt="Company Logo {{ $companyProfile->company_name }}" loading="lazy"
    {{ $attributes->merge(['class' => 'w-16 h-16 object-cover rounded-full']) }}>