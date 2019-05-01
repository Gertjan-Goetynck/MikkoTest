# PHP test

This is a small utility application made as a test.

The goal is to write an app that generates a list of dates when employees need to be payed during a given year. No frameworks or databases were used in this test. This is pure vanilla PHP

Features:

- Users can input the year they require the data of
- Staff gets payed on the last day of the month. If this is during a weekend, they get payed on the last friday of the month.
- Employees receive monthly bonusses every 15th of the following month. If this is during a weekend, they receive the bonus on the following wednesday.
- The data can be downloaded as a CSV file
