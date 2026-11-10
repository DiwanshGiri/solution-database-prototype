# Solution Database Prototype

An early, independently developed Laravel prototype for browsing digital solutions for business problems.

## Included at this checkpoint

- Seeded example data for testing
- Browse a problem, then its solutions, then linked products/services
- Client-side tag filtering without reloading the page
- Create, read, update, and delete business problems
- Create, read, update, and delete solutions
- Create, read, update, and delete products/services
- SQLite database with the `consult_` table prefix
- Automated test for problem management

## Still outside this checkpoint

- Standalone tag management
- KPI recommendation and case recording

## Run

```bash
php artisan migrate:fresh --seed
php artisan test
php artisan serve
```

Open `http://127.0.0.1:8000`.
