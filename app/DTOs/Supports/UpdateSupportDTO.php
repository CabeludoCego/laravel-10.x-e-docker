<?php

namespace App\DTOs\Supports;

use App\Enums\SupportStatus;
use App\Http\Requests\StoreUpdateSupportRequest;
use App\Models\Support;
use Illuminate\Support\Facades\Storage;

class UpdateSupportDTO
{
	public function __construct(
		public string $id,
		public string $subject,
		public SupportStatus $status,
		public string $body,
		public string|null $image
	) {	}
	

	public static function makeFromRequest(StoreUpdateSupportRequest $request, string $id = null ) : self
	{
		$support_data = Support::where('id', $id)->first();
		$support_image = $support_data->image;

		if ($request->image) 
		{
			if($support_data->image && Storage::exists($support_data->image)) 
			{
				Storage::delete($support_data->image);
			}
			$extension = $request->image->getClientOriginalExtension();
			$support_image = $request->image->storeAs('supports', now() . ".{$extension}");
		}

		return new self(
			$id ?? $request->id,
			$request->subject,
			SupportStatus::A,
			$request->body,
			$support_image
		);
	}
}