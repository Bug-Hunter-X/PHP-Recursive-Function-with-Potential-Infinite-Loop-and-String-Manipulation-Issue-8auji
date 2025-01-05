```php
function processData(array $data): array {
  foreach ($data as $key => $value) {
    if (is_array($value)) {
      $data[$key] = processData($value); // Recursive call
    } else if (is_string($value) && strpos($value, 'error') !== false) {
      // Handle error strings
      $data[$key] = str_replace('error', 'Error', $value);
    }
  }
  return $data;
}

$input = [
  'name' => 'John Doe',
  'details' => [
    'address' => '123 Main St',
    'status' => 'error: inactive',
  ],
  'notes' => 'Some error in the system',
];

$result = processData($input);
print_r($result);
```