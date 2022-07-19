<?php

namespace App\View\Components\frontend;

use App\Models\Category;
use Illuminate\View\Component;

class CategoryDropdown extends Component
{
  public function render()
  {
    return view('components.frontend.category-dropdown', [
      'categories' => Category::all(),
      'currentCategory' => Category::firstWhere('slug', request('category')),
    ]);
  }
}
