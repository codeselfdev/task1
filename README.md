# Identity Manager

This will verify citizen's identity document.I have used docker and symfony 4.3.
## Getting Started
1. Run `git init` to initiate git in empty folder.
2. Run `git clone  https://github.com/codeselfdev/task1.git` for cloning this repo into your local repo.
3.Run `cd task1` to navigate in the root app folder.
3. Now Run `docker-compose up` (the logs will be displayed in the current shell)
4. Run `composer install` for installing all the necesary packages if not already downloaded.
5. **Ready!**

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
