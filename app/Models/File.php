<?php
  namespace App\Models;

  use Illuminate\Support\Facades\File as Model;
  use Storage;

  class File extends Model {
    /**
     * * Get all the files from a route
     * @static
     * @param string $route
     * @param array $conf
     * @return [string[]]
     */
    static public function all (string $route, array $conf = [
      'disk' => 'public',
      'storage' => true,
    ]) {
      $conf = array_merge($conf, File::$conf);

      $files = collect();

      if ($conf['storage']) {
        if (count(Storage::disk($conf['disk'])->allFiles($route))) {
          $files = Storage::disk($conf['disk'])->allFiles($route);
        }
      } else {
        foreach (File::files("img/$route") as $file) {
          $files->push($file->getPathname());
        }
      }

      return $files;
    }

    /**
     * * Default configuration.
     * @static
     * @var array
     */
    static public $conf = [
      'disk' => 'public',
      'storage' => true,
    ];
  }