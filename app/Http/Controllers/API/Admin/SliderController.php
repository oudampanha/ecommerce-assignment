<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->paginate(10);
        return response()->json([
            'status' => 'success',
            'sliders' => $sliders
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'slider_description' => 'required|string|max:255',
            'slider_image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $validated['slider_image'] = $request->file('slider_image')->store('sliders', 'public');

        $slider = Slider::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Slider created successfully',
            'slider' => $slider
        ], 201);
    }

    public function show(Slider $slider)
    {
        return response()->json([
            'status' => 'success',
            'slider' => $slider
        ]);
    }

    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'slider_description' => 'sometimes|required|string|max:255',
            'slider_image' => 'sometimes|required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('slider_image')) {
            Storage::disk('public')->delete($slider->slider_image);
            $validated['slider_image'] = $request->file('slider_image')->store('sliders', 'public');
        }

        $slider->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Slider updated successfully',
            'slider' => $slider->fresh()
        ]);
    }

    public function destroy(Slider $slider)
    {
        Storage::disk('public')->delete($slider->slider_image);
        $slider->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Slider deleted successfully'
        ]);
    }
}
