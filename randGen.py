import random

ll = []

t = "a quick brown fox jumps over the lazy dog"
print(len(t))
print(len(set(list(t))))

while(len(ll) != 26):
    temp = random.randint(0, 40)
    if t[temp] not in ll and t[temp] != " ":
        ll.append(t[temp])

print(ll)
ou = []
for i in range(26):
    ou.append("var "+ll[25-i]+" = jotform.charAt("+str(t.index(ll[i]))+");")
print("\n".join(ou))

pss = "talk is cheap show me the code"
ans = []
for chr in pss:
    if(chr == ' '):
        continue
    loc = ll.index(chr)
    ans.append(ll[25-loc])
print("secret=(", '+'.join(ans), ")")
