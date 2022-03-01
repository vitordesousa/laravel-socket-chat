

# Laravel Chat (in development)

### TODO:
- [ ] User start conversation
- [ ] Add user to group "users" when register
- [ ] User end conversation (and set status 2 or 3 (*depends: read CreateConversationsTable*))
- [ ] When user start conversation, show on administrator screen has user waiting to be attended
- [ ] Admin catch user needing to start conversation
- [ ] All unread messages with dot confirmation when refresh window
- [ ] Remove login from Controllers
- [ ] Refactor Vue Chat Component

### Made with:
- [Laravel 9](https://laravel.com) <a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="80" valign="top"></a>
- [Vue 3](https://vuejs.org)
- [Inertia JS](https://inertiajs.com)
- [Laravel Websockets](https://beyondco.de/docs/laravel-websockets/getting-started/introduction)

### Followed tutorial:
[Gustavo Web](https://www.youtube.com/watch?v=HumFv2NAQnU&list=PLBRCgwXk28ixXJEKlWaoUuG38rJAod0AP)

### Local deploy

*Composer* ```composer install```

*Run migrates:* ```php artisan migrate```

When run migrates, users will be create, 2 administrators and 8 users with respective access:
```admin@admin.com``` ```password```
```admin2@admin.com``` ```password```

```user1@user.com``` ```password```
```user2@user.com``` ```password```
```user3@user.com``` ```password```
```user4@user.com``` ```password```
```user5@user.com``` ```password```
```user6@user.com``` ```password```
```user7@user.com``` ```password```
```user8@user.com``` ```password```

```npm run dev```

```composer install```

*To Laravel:* ```php artisan serve```
*To WebSockets (in another prompt tab):*  ```php artisan websockets:serve```



##### License
[MIT license](https://opensource.org/licenses/MIT).
