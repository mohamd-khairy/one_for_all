<?php

function responseSuccess($data = [], $message = 'success', $status = 200)
{
    return response()->json([
        "status" => true,
        "message" => $message,
        "data" => $data
    ], $status);
}

function responseFail($message = 'something wrong', $status = 400)
{
    return response()->json([
        "status" => false,
        "message" => $message,
    ], $status);
}

function responseValidation($errors = [], $code = 422)
{
    return response()->json([
        "status" => false,
        "message" => array_values($errors) ? (array_values($errors)[0] ? array_values($errors)[0][0] : '') : '',
    ], 422);
}

function current_url()
{
    return url()->current();
}

function translated_fields($model, $request)
{
    $data = $request;
    try {
        if (count(config('translatable.locales', [])) > 1) {
            $fields = new $model;
            $fields = $fields->gettranslatable();
            if ($fields) {
                foreach (config('translatable.locales', []) as $lang) {
                    $tr = [];
                    foreach ($fields as $field) {
                        $tr[$field] = $request[$field . '_' . $lang] ?? $request[$field] ?? null;
                        unset($data[$field . '_' . $lang]);
                    }
                    $data[$lang] = $tr;
                }
            }
        }
        return $data;
    } catch (\Throwable $th) {
        return $data;
    }
}

function get_address_from_google($lat, $long, $lang)
{
    try {
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $lat . ',' . $long .
            '&language=' . $lang . '&key=' . config('app.google_map_key');

        $google_address = json_decode(file_get_contents($url), true);

        if (!$google_address) {
            return false;
        }

        $address = [
            'full_address' => null,
            'state' => null,
            'district' => null,
            'street' => null,
            'country' => null,
        ];

        $address['full_address'] = isset($google_address['results'][0]['formatted_address'])  ? $google_address['results'][0]['formatted_address'] : null;

        if (isset($google_address['results'][0]['address_components'])) {
            foreach ($google_address['results'][0]['address_components'] as $address_data) {
                if (
                    in_array('administrative_area_level_1', $address_data['types'])
                ) {
                    $address['state'] = $address_data['long_name'];
                } elseif (
                    in_array('administrative_area_level_2', $address_data['types']) || in_array('neighborhood', $address_data['types']) ||
                    in_array('sublocality_level_1', $address_data['types'])
                ) {
                    $address['district'] = $address_data['long_name'];
                } elseif (
                    in_array('administrative_area_level_3', $address_data['types']) || in_array('route', $address_data['types'])
                ) {
                    $address['street'] = $address_data['long_name'];
                } elseif (
                    in_array('country', $address_data['types'])
                ) {
                    $address['country'] = $address_data['long_name'];
                }
            }
        }
        return $address;
    } catch (\Exception $ex) {
        return false;
    }
}
