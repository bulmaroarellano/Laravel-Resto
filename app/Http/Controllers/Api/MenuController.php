<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Resources\MenuResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\MenuCollection;
use App\Http\Requests\MenuStoreRequest;
use App\Http\Requests\MenuUpdateRequest;

class MenuController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Menu::class);

        $search = $request->get('search', '');

        $menus = Menu::search($search)
            ->latest()
            ->paginate();

        return new MenuCollection($menus);
    }

    /**
     * @param \App\Http\Requests\MenuStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuStoreRequest $request)
    {
        $this->authorize('create', Menu::class);

        $validated = $request->validated();

        $menu = Menu::create($validated);

        return new MenuResource($menu);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Menu $menu)
    {
        $this->authorize('view', $menu);

        return new MenuResource($menu);
    }

    /**
     * @param \App\Http\Requests\MenuUpdateRequest $request
     * @param \App\Models\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function update(MenuUpdateRequest $request, Menu $menu)
    {
        $this->authorize('update', $menu);

        $validated = $request->validated();

        $menu->update($validated);

        return new MenuResource($menu);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Menu $menu)
    {
        $this->authorize('delete', $menu);

        $menu->delete();

        return response()->noContent();
    }
}
