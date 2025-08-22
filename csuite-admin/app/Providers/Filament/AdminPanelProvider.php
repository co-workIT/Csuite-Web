<?php

namespace App\Providers\Filament;

use App\Models\PricingFeaturePlan;
use App\Models\PricingPlan;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Assets\Font;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\Resources\AddOnCategories\AddOnCategoriesResource;
use App\Filament\Resources\Addons\AddonResource;
use App\Filament\Resources\Products\ProductResource;
use App\Filament\Resources\ProductCards\ProductCardResource;
use App\Filament\Resources\Features\FeatureResource;
use App\Filament\Resources\PricingFeatures\PricingFeatureResource;
use App\Filament\Resources\PricingPlans\PricingPlanResource;
use App\Filament\Resources\Blogs\BlogResource;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('/')
            ->login()
            // ->domain(env('APP_URL', 'localhost'))
            ->colors([
                'primary' => Color::Blue,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->brandName("CSuite")
            ->favicon(asset("images/csuite-logo-small.png"))
            ->sidebarCollapsibleOnDesktop()
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->plugins([
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->navigationGroups([
                NavigationGroup::make()
                    ->label("Addon Setup")
                    ->icon('heroicon-o-home'),
            ])
            ->navigation(function (NavigationBuilder $builder) {
                return $builder->groups([
                    NavigationGroup::make()
                        ->items([
                            \Filament\Navigation\NavigationItem::make('Dashboard')
                                ->icon('heroicon-o-home')
                                ->url(route('filament.admin.pages.dashboard')),
                        ]),

                    NavigationGroup::make()
                        ->items([
                            ...BlogResource::getNavigationItems(),
                        ])
                        ->collapsed()
                        ->label('Blog')
                        ->icon('heroicon-o-pencil-square'),

                    NavigationGroup::make('Addon Setup')
                        ->items([
                            ...AddOnCategoriesResource::getNavigationItems(),
                            ...AddonResource::getNavigationItems(),
                        ])
                        ->icon('heroicon-o-puzzle-piece')
                        ->collapsed(),

                    NavigationGroup::make('Mega Menu Setup')
                        ->items([
                            ...ProductResource::getNavigationItems(),
                            ...ProductCardResource::getNavigationItems(),
                            ...FeatureResource::getNavigationItems(),
                        ])
                        ->icon('heroicon-o-rectangle-stack')
                        ->collapsed(),

                    NavigationGroup::make('Pricing Setup')
                        ->items([
                            ...PricingPlanResource::getNavigationItems(),
                            ...PricingFeatureResource::getNavigationItems(),
                        ])
                        ->icon('heroicon-o-currency-dollar')
                        ->collapsed(),
                ]);
            });

    }
}
