<?php
  namespace App\Models;

  use Auth;
  use Cviebrock\EloquentSluggable\Sluggable;
  use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
  use Illuminate\Contracts\Auth\MustVerifyEmail;
  use Illuminate\Foundation\Auth\User as Authenticatable;
  use Illuminate\Notifications\Notifiable;

  class User extends Authenticatable {
    use Notifiable, Sluggable, SluggableScopeHelpers;

    /**
     * * The table name.
     * @var string
     */
    protected $table = 'users';

    /**
     * * The table primary key name.
     * @var string
     */
    protected $primaryKey = 'id_user';

    /**
     * * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
      'email',
      'name',
      'password',
      'slug',
    ];

    /**
     * * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
      'password',
    ];

    /**
     * * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
      'email_verified_at' => 'datetime',
    ];

    /**
     * * The Sluggable configuration for the Model.
     * @return array
     */
    public function sluggable () {
      return [
        'slug' => [
          'onUpdate' => true,
          'source' => 'name',
        ],
      ];
    }
  }