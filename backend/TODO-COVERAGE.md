# Code Coverage Improvement Plan - Remaining Steps

## Current Status
- **Starting Coverage:** 52.8%
- **Current Coverage:** 76.78% (797/1038 lines)
- **Target Coverage:** 80-90%
- **Completed Steps:** 2/9
- **Remaining Gap:** ~3-13 percentage points to reach target

## ✅ Completed Steps

### Step 1: User Authentication & Security (+15 percentage points)
- Created `UserLoginControllerTest.php`
- Created `UserResetPasswordControllerTest.php`  
- Created `UserAuthenticatorTest.php`
- All authentication flows covered with comprehensive test scenarios

### Step 2: Team Management Controllers (+Coverage but with performance issues)
- Created `TeamUserControllerTest.php`
- Created `TeamDashboardControllerTest.php`
- Created `TeamSerpControllerTest.php`
- Created `LoadTeamUsers.php` fixture
- **Issue:** Many tests are timing out (10-second limit), affecting coverage calculation

## 🔄 Remaining Steps (Steps 3-9)

---

## Step 3: Fix Performance Issues & Optimize Tests
**Priority:** HIGH (Immediate)
**Expected Impact:** Accurate coverage reporting + potential 2-5 percentage points

### Specific Tasks:
1. **Fix Timeout Issues in TeamSerpController Tests**
   ```bash
   # Analyze why tests are timing out
   docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && php vendor/bin/phpunit tests/Controller/TeamSerpControllerTest.php::testPreviewWorksWithSerpRole --verbose --debug"
   ```

2. **Optimize Test Data Loading**
   - Reduce fixture data size for faster loading
   - Consider using smaller datasets for SERP generation tests
   - Add timeout configuration to phpunit.xml if needed

3. **Simplify Complex Tests**
   - Replace heavy SERP generation tests with unit tests
   - Mock expensive operations in `PlanIdGenerator` and `TitleIdGenerator`

4. **Files to Modify:**
   - `tests/Controller/TeamSerpControllerTest.php`
   - Potentially `phpunit.xml.dist` for timeout settings

---

## Step 4: Complete Home Controller Edge Cases
**Priority:** MEDIUM
**Expected Impact:** 1-2 percentage points

### Coverage Gaps:
- `HomeController::countActivities()` method (lines 146-159 uncovered)
- Missing edge case handling in activity counting

### Specific Tasks:
1. **Analyze Missing Coverage**
   ```bash
   # Check what lines are uncovered
   grep -n "countActivities" backend/src/Controller/HomeController.php
   ```

2. **Create Tests for Edge Cases**
   - Test activity counting with empty database
   - Test activity counting with specific locale constraints
   - Test error handling in counting logic

3. **Files to Create/Modify:**
   - Add tests to existing `tests/Controller/HomeControllerTest.php`
   - Focus on the missing `countActivities` method coverage

---

## Step 5: Command Coverage & Import System
**Priority:** HIGH (0% coverage)
**Expected Impact:** 1-2 percentage points

### Coverage Gaps:
- `App\Command\RetromatImportActivitiesCommand`: 0% (0/3 methods, 0/9 lines)

### Specific Tasks:
1. **Create Command Test**
   ```php
   // Create: tests/Command/RetromatImportActivitiesCommandTest.php
   ```

2. **Test Scenarios:**
   - Command execution with valid input
   - Command execution with invalid input
   - Error handling during import process
   - Integration with ActivityImporter service

3. **Mock Requirements:**
   - Mock file system operations
   - Mock ActivityImporter service
   - Test command output and exit codes

---

## Step 6: Complete User Management System
**Priority:** HIGH
**Expected Impact:** 3-4 percentage points

### Coverage Gaps:
- `App\Model\User\UserManager`: 40% (2/5 methods, 13/25 lines)
- `App\Model\User\UserResetPasswordManager`: 28.57% (2/7 methods, 22/50 lines)
- `App\Repository\UserResetPasswordRepository`: 33.33% (1/3 methods, 1/13 lines)
- `App\Entity\UserResetPasswordRequest`: 14.29% (1/7 methods, 5/11 lines)

### Specific Tasks:
1. **Create UserManager Tests**
   ```php
   // Create: tests/Model/User/UserManagerTest.php
   ```
   - Test user creation, persistence, and deletion
   - Test password hashing and validation
   - Test user role management

2. **Expand UserResetPasswordManager Tests**
   ```php
   // Create: tests/Model/User/UserResetPasswordManagerTest.php
   ```
   - Test token generation and validation
   - Test token expiration handling
   - Test password reset flow end-to-end

3. **Create Repository Tests**
   ```php
   // Create: tests/Repository/UserResetPasswordRepositoryTest.php
   ```
   - Test token storage and retrieval
   - Test cleanup of expired tokens
   - Test query methods

4. **Entity Tests**
   ```php
   // Expand: tests/Entity/UserResetPasswordRequestTest.php
   ```
   - Test all getter/setter methods
   - Test validation logic
   - Test relationships

---

## Step 7: Form Handling Coverage
**Priority:** MEDIUM
**Expected Impact:** 0.5-1 percentage points

### Coverage Gaps:
- `App\Form\UserResetPasswordFormType`: 0% (0/1 methods, 0/1 lines)

### Specific Tasks:
1. **Create Form Tests**
   ```php
   // Create: tests/Form/UserResetPasswordFormTypeTest.php
   ```
   - Test form building and configuration
   - Test field validation
   - Test form submission handling

2. **Integration with Controllers**
   - Ensure form usage is covered in controller tests
   - Test form error handling

---

## Step 8: Sitemap & SEO Features
**Priority:** MEDIUM  
**Expected Impact:** 6-8 percentage points

### Coverage Gaps:
- `App\Model\Sitemap\ActivityUrlGenerator`: 0% (0/5 methods, 0/62 lines)
- `App\Model\Sitemap\Subscriber\SitemapPopulateSubscriber`: 33.33% (1/3 methods, 3/10 lines)

### Specific Tasks:
1. **Create Sitemap Tests**
   ```php
   // Create: tests/Model/Sitemap/ActivityUrlGeneratorTest.php
   // Create: tests/Model/Sitemap/SitemapPopulateSubscriberTest.php
   ```

2. **Test Scenarios:**
   - URL generation for activities in different locales
   - Sitemap population with various activity sets
   - Event subscriber functionality
   - SEO metadata generation

3. **Integration Tests:**
   - Test sitemap generation end-to-end
   - Validate generated URLs are accessible
   - Test sitemap XML format compliance

---

## Step 9: Final Optimizations & Team Activity Completion
**Priority:** LOW
**Expected Impact:** 2-3 percentage points

### Coverage Gaps:
- `App\Controller\TeamActivityController`: 62.50% (5/8 methods, 46/67 lines)
- `App\Controller\TeamUserController`: Complete remaining methods

### Specific Tasks:
1. **Complete TeamActivity Tests**
   - Cover missing controller methods
   - Add integration tests for activity CRUD operations
   - Test permissions and role-based access

2. **Performance Optimization**
   - Review and optimize slow tests
   - Implement test grouping for faster CI
   - Add parallel test execution if needed

3. **Documentation & Maintenance**
   - Document test patterns and conventions
   - Create test data fixtures documentation
   - Set up coverage monitoring

---

## Execution Instructions

### Pre-Execution Checklist:
```bash
# 1. Ensure Docker environment is running
docker-compose up -d

# 2. Verify current coverage baseline
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && ./quality-checks-in-docker.sh"

# 3. Note current coverage percentage from output
```

### Step-by-Step Execution:

#### For Each Step:
1. **Create Test Files** as specified in the step details
2. **Run Quality Checks**:
   ```bash
   docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && ./quality-checks-in-docker.sh"
   ```
3. **Fix Any Issues** that arise from PHPStan, CS-Fixer, or test failures
4. **Measure Progress**:
   ```bash
   # Extract coverage from output and compare to previous
   # Target: Each step should add 1-8 percentage points
   ```
5. **Document Results** in this file

#### After All Steps:
```bash
# Final verification
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && ./quality-checks-in-docker.sh"
# Should show 80-90% total coverage
```

---

## Critical Notes

### Performance Considerations:
- **Test Timeouts:** Current issue with SERP tests timing out after 10 seconds
- **Fixture Loading:** Heavy activity data loading is slow - consider optimization
- **Memory Usage:** Monitor memory consumption during coverage generation

### Test Patterns to Follow:
1. **Authentication:** Use `$this->client->loginUser($testUser)` pattern
2. **Fixtures:** Load minimal required data: `LoadActivityData` + `LoadTeamUsers`
3. **Assertions:** Use flexible assertions for redirects and status codes
4. **Mocking:** Mock external services and file operations
5. **Error Handling:** Test both success and failure scenarios

### Quality Standards:
- All new tests must pass PHPStan analysis
- Code must follow project's CS-Fixer standards
- Test methods must have explicit return type hints (`: void`)
- Use descriptive test method names explaining the scenario

### Troubleshooting:
- **500 Errors:** Usually indicate missing fixtures or service dependencies
- **403 Errors:** Check user roles and permissions in test fixtures
- **Timeout Issues:** Reduce test complexity or increase timeout limits
- **Memory Issues:** Use `php -d memory_limit=2000M` for coverage generation

---

## Success Criteria

### Target Metrics:
- **Total Coverage:** 80-90% (current: 76.78%)
- **Method Coverage:** 85%+ (current: 76.04%)
- **Class Coverage:** 60%+ (current: 53.06%)

### Quality Gates:
- ✅ All PHPStan checks pass
- ✅ All CS-Fixer checks pass  
- ✅ All tests pass (no failures or errors)
- ✅ No risky tests due to timeouts
- ✅ Coverage improvement visible after each step

**Estimated Total Time:** 8-12 hours across all remaining steps
**Priority Order:** Steps 3 → 5 → 6 → 4 → 8 → 7 → 9