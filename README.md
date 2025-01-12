# Simple Vehicle Tracing

<p align="center">
    <img src="https://img.shields.io/badge/Made_with-PHP-%23777BB4?style=flat&logo=php" alt="Made with PHP">
    <img src="https://img.shields.io/badge/Latest_version-1.0.0-green" alt="Latest version">
</p>

A simple API made with PHP to trace vehicles in real time

### Features
- Vehicle ID & Passkey (only you can update your position with the passkey)
- Multiple clients (clients can see vehicle positions)
- MySQL based
- API access to get all or specific vehicle location (with client passkey)

### Planned Features
- Better client
- Vehicle location log
- Vehicle client

### Requirements
- Web server with PHP
- MySQL server

### Installation Guide
- Download resources: Go to [Releases](https://github.com/deltagamesyt/simple-vehicle-tracing/releases) and download `database.sql` and `server.zip` from the latest release.
- Configure MySQL: Import `database.sql` to your MySQL server. The import will create a database named `vehicles`, but you can rename it.
- Upload files to your server: Unzip `server.zip` and upload the contents to your web server.
- Setup the server: Open `config/config.php`, and setup the MySQL credentials.
- Now, the API is ready. You can easily read and write data to your server. More info and API usage available in [wiki](https://github.com/deltagamesyt/simple-vehicle-tracing/wiki).
- For now, the software don't have a client for the vehicle, but you can use [mendhak/gpslogger](https://github.com/mendhak/gpslogger) and set up sending to a custom URL. I'm working in the vehicle client.

> Make sure you always use the latest version of the software, because outdated versions may cause security issues or bugs.

### API Documentation
Check the [Wiki](https://github.com/deltagamesyt/simple-vehicle-tracing/wiki)

### Problems?
Check the [Wiki](https://github.com/deltagamesyt/simple-vehicle-tracing/wiki) or [Leave your issue](https://github.com/deltagamesyt/simple-vehicle-tracing/issues)

> This software may contain bugs, or non-optimized code. Please leave your issue for suggestions, problems or questions.