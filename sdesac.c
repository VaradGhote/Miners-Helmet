#include<stdio.h>

int main()
{
    int a;
    int z,n;
    scanf("%d",&a);
    z=a;
    while(z != 0)
    {
        z=z/2;
        n++;
        
    }
    int arr[100];
    z=a;

    for(int i=0;i<n;i++)
    {
        arr[i]=z%2;
        z=z/2;
    }

    for(int i=0;i<n;i++)
    {
        printf("%d ",arr[n-i-1]);
    }

}
