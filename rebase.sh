# make sure we're at `main`
if [ "refs/heads/main" != "$(git symbolic-ref HEAD)" ]
then
  git checkout main
fi

# commit if there are uncommited changes
git update-index --refresh
HAS_UNCOMMITTED_CHANGES=$(git diff-index --quiet HEAD --; echo $?)
if [ "$HAS_UNCOMMITTED_CHANGES" ]
then
  # fixup init commit
  git add .
  git commit -m "fixup! Init commit"
fi

# rebase
GIT_SEQUENCE_EDITOR=true git rebase -i --root --autosquash

# reset the follow-along branch
ROOT_COMMIT=$(git rev-list --max-parents=0 HEAD)
git checkout follow-along
git reset --hard "$ROOT_COMMIT"

# reset tags
git checkout main
git tag -fs step-8 -m "" HEAD~1
git tag -fs step-7 -m "" HEAD~5
git tag -fs step-6 -m "" HEAD~7
git tag -fs step-5 -m "" HEAD~10
git tag -fs step-4 -m "" HEAD~11
git tag -fs step-3 -m "" HEAD~15
git tag -fs step-2 -m "" HEAD~17
