```php
function processData(array $data, array &$visited = []): array {
  $key = spl_object_hash($data);
  if (isset($visited[$key])) {
    return $data; // Prevent infinite loop for circular references
  }
  $visited[$key] = true;

  foreach ($data as $key => $value) {
    if (is_array($value)) {
      $data[$key] = processData($value, $visited);
    } else if (is_string($value)) {
      // Improved error handling
      $errorPos = strpos(strtolower($value), 'error');
      if ($errorPos !== false) {
        $errorCode = substr($value, $errorPos, 10); //Extract error code. 
        $data[$key] = "Error: $errorCode";
      }
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
  'notes' => 'Some error code 123 in the system',
  'circular' => []
];

$input['circular'] = &$input; // Circular reference

$result = processData($input);
print_r($result);
```