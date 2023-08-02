<?php

namespace App\DTOs\Supports;

use App\Enums\SupportStatus;
use App\Http\Requests\StoreUpdateSupportRequest;

class CreateSupportDTO 
{
	public function __construct(
		public string $subject,
		public SupportStatus $status,
		public string $body,
		public string|null $image
	) {

	}
	

	public static function makeFromRequest(StoreUpdateSupportRequest $request) : self
	{
		$data_image = null;
		if ($request->image) 
		{
			$extension = $request->image->getClientOriginalExtension();
			$data_image = $request->image->storeAs('supports', now() . ".{$extension}");
		}

		return new self(
			$request->subject,
			SupportStatus::A,
			$request->body,
			$data_image
		);
	}
}