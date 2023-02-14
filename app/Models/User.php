<?php declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use OwenIt\Auditing\Auditable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use App\Models\Concerns\HasRelations;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use App\Models\Contracts\BaseModelContract;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use BezhanSalleh\FilamentShield\Traits\HasFilamentShield;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use JeffGreco13\FilamentBreezy\Traits\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends BaseModel implements FilamentUser, AuditableContract, AuthenticatableContract, AuthorizableContract, CanResetPasswordContract, BaseModelContract, Contracts\HasSlug
{
    use HasApiTokens;
    use HasRelations;
    use Auditable;
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use HasFilamentShield;
    use TwoFactorAuthenticatable;
    use Impersonate;
    use Authenticatable;
    use Authorizable;
    use CanResetPassword;
    use Concerns\HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function canAccessFilament(): bool
    {
        return Auth::user()->hasRole(['super_admin', 'superadmin', 'admin', 'manager']);
    }

    public static function currentUser(string $guard = null): ?self
    {
        if (!empty($guard)) {
            return Auth::guard($guard)->user();
        }

        return Auth::user();
    }

    public function canImpersonate()
    {
        return true;
    }

    public function canBeImpersonated()
    {
        // Let's prevent impersonating other users at our own company
        // return !Str::endsWith($this->email, '@mycorp.com');
        return true;
    }
}
