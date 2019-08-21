# Identity Manager

This will verify citizen's identity document.I have used docker and symfony 4.3.
## Getting Started

1. Run `docker-compose up` (the logs will be displayed in the current shell)
2. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
3. **Enjoy!**

## Testing

I have write all the citizens information provided inside sample csv.In total I have write 14 cases and their expected result to verify this functions.For Run all test case run bellow command. 
```bash
php bin/phpunit
```
like this output will be display if successfully run

```bash
PHPUnit 7.5.15 by Sebastian Bergmann and contributors.

Testing Project Test Suite
.                                                                   1 / 1 (100%)

Time: 302 ms, Memory: 6.00 MB

[30;42mOK (1 test, 14 assertions)[0m
```

## Output Command
For seeing all the sample case inside input.csv file run bellow command, 
```bash
cat input.csv
```
For Running the identification process in command line run this

```bash
php bin/console identification-requests:process input.csv
```
it will output following results
```bash
valid
valid
valid
document_number_length_invalid
request_limit_exceeded
valid
document_is_expired
valid
document_type_is_invalid
valid
valid
document_number_invalid
valid
document_issue_date_invalid
```

## Credits

Created and developed by Raonak Islam Niloy.
