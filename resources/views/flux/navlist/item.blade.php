@php $iconTrailing ??= $attributes->pluck('icon:trailing'); @endphp
@php $iconVariant ??= $attributes->pluck('icon:variant'); @endphp

@aware([ 'variant' ])

@props([
    'iconVariant' => 'outline',
    'iconTrailing' => null,
    'badgeColor' => null,
    'variant' => null,
    'iconDot' => null,
    'accent' => true,
    'badge' => null,
    'icon' => null,
])

@php
// Button should be a square if it has no text contents...
$square ??= $slot->isEmpty();

// Size-up icons: Changed from size-5/size-4 to size-6/size-5
$iconClasses = Flux::classes($square ? 'size-6!' : 'size-5!');

$classes = Flux::classes()
    // Height Increase: Changed 'h-10 lg:h-8' to 'h-12 lg:h-10' (40px desktop / 48px mobile)
    ->add('h-12 lg:h-10 relative flex items-center gap-3 rounded-xl transition-colors duration-200') 
    ->add($square ? 'px-2.5!' : '')
    // Padding Increase: Changed 'px-3' to 'px-4' and added 'my-0.5' for slight vertical separation
    ->add('py-0 text-start w-full px-4 my-0.5')
    ->add('text-slate-500 dark:text-slate-400') 
    ->add(match ($variant) {
        'outline' => match ($accent) {
            true => [
                'data-current:text-purple-600 dark:data-current:text-purple-300',
                'data-current:bg-purple-50 dark:data-current:bg-purple-500/10',
                'data-current:border data-current:border-purple-200 dark:data-current:border-purple-500/20',
                'hover:text-purple-600 dark:hover:text-purple-300', 
                'hover:bg-purple-50 dark:hover:bg-purple-500/10',
                'border border-transparent',
            ],
            false => [
                'data-current:text-slate-800 dark:data-current:text-slate-100 data-current:border-slate-200',
                'data-current:bg-white dark:data-current:bg-white/10 data-current:border data-current:border-slate-200 dark:data-current:border-white/10 data-current:shadow-xs',
                'hover:text-slate-800 dark:hover:text-white',
            ],
        },
        default => match ($accent) {
            true => [
                'data-current:text-white dark:data-current:text-white',
                'data-current:bg-purple-600 dark:data-current:bg-purple-600 shadow-md shadow-purple-500/20',
                'hover:text-slate-800 dark:hover:text-white',
                'hover:bg-purple-50 dark:hover:bg-purple-500/20',
            ],
            false => [
                'data-current:text-slate-800 dark:data-current:text-slate-100',
                'data-current:bg-slate-800/[4%] dark:data-current:bg-white/10',
                'hover:text-slate-800 dark:hover:text-white hover:bg-slate-800/[4%] dark:hover:bg-white/10',
            ],
        },
    })
    ;
@endphp

<flux:button-or-link :attributes="$attributes->class($classes)" data-flux-navlist-item>
    <?php if ($icon): ?>
        <div class="relative">
            <?php if (is_string($icon) && $icon !== ''): ?>
                <flux:icon :$icon :variant="$iconVariant" class="{!! $iconClasses !!}" />
            <?php else: ?>
                {{ $icon }}
            <?php endif; ?>

            <?php if ($iconDot): ?>
                <div class="absolute top-[-2px] end-[-2px]">
                    <div class="size-[6px] rounded-full bg-purple-500 dark:bg-purple-400"></div>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if ($slot->isNotEmpty()): ?>
        <div class="flex-1 text-sm font-medium leading-none whitespace-nowrap [[data-nav-footer]_&]:hidden [[data-nav-sidebar]_[data-nav-footer]_&]:block" data-content>{{ $slot }}</div>
    <?php endif; ?>

    <?php if (is_string($iconTrailing) && $iconTrailing !== ''): ?>
        <flux:icon :icon="$iconTrailing" :variant="$iconVariant" class="size-4!" />
    <?php elseif ($iconTrailing): ?>
        {{ $iconTrailing }}
    <?php endif; ?>

    <?php if (isset($badge) && $badge !== ''): ?>
        <?php $badgeAttributes = Flux::attributesAfter('badge:', $attributes, ['color' => $badgeColor]); ?>
        <flux:navlist.badge :attributes="$badgeAttributes">{{ $badge }}</flux:navlist.badge>
    <?php endif; ?>
</flux:button-or-link>